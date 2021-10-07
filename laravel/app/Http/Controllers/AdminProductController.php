<?php

namespace App\Http\Controllers;

use App\Components\loadCategory;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;
class AdminProductController extends Controller
{
    private $category;
    use StorageImageTrait;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImage $productImage,
                                Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentID = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function getCategory($parentID)
    {
        $data = $this->category->all();
        $loadCategory = new loadCategory($data);
        $htmlOption = $loadCategory->load($parentID);
        return $htmlOption;
    }

    public function store(ProductRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataInsertProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image_path', 'product');
            if(!empty($dataUploadImage)){
                $dataInsertProduct['feature_image_name'] = $dataUploadImage['file_name'];
                $dataInsertProduct['image_path'] = $dataUploadImage['file_path'];
            }
            $product =  $this->product->create($dataInsertProduct);
            // insert data to product_images
            if($request->hasFile('list_image_path'))
            {
                foreach ($request->list_image_path as $fileItem)
                {
                    $dataProductImageDetail = $this->storageTraitUploadMutilple($fileItem,'product');
                    $product->images()->create([
                        'list_image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);

                }
            }
            // insert tag to product tag
           if(!empty($request->tags)){
               foreach ($request->tags as $tagItem){
                   $tagInstance = $this->tag->firstOrCreate([
                       'name' => $tagItem,
                   ]);
                   $tagId[] = $tagInstance->id;
               }
           }
            $product->tags()->attach($tagInstance); // thêm id vào bảng tag vì phương thức này sẽ truyền cả khóa ngoại
            DB::commit();
            return redirect()->route('product.index');
        }catch (Exception $exception){

            Log::error('Message: '.$exception->getMessage() . 'Line' . $exception->getLine());
            DB::rollBack();
        }

    }
    public function edit($id){
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category->id);

        return view('admin.product.edit',compact('product','htmlOption'));
    }
    public function update($id, Request $request){
        try{
            DB::beginTransaction();
            $dataUpdateProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image_path', 'product');
            if(!empty($dataUploadImage)){
                $dataUpdateProduct['feature_image_name'] = $dataUploadImage['file_name'];
                $dataUpdateProduct['image_path'] = $dataUploadImage['file_path'];
            }
            $this->product->find($id)->update($dataUpdateProduct);
            $product =  $this->product->find($id);
            // insert data to product_images
            if($request->hasFile('list_image_path'))
            {
                foreach ($request->list_image_path as $fileItem)
                {
                    $this->productImage->where('product_id',$id)->delete();
                    $dataProductImageDetail = $this->storageTraitUploadMutilple($fileItem,'product');
                    $product->images()->create([
                        'list_image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);

                }
            }

            // insert tag to product tag
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem){
                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tagItem,
                    ]);
                    $tagId[] = $tagInstance->id;
                }

            }
            $product->tags()->sync($tagId);
           // thêm id vào bảng tag vì phương thức này sẽ truyền cả khóa ngoại
            DB::commit();
            return redirect()->route('product.index');
        }catch (Exception $exception){
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage() . 'Line' . $exception->getLine());
        }
    }
    public function delete($id){
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code' =>200,
                'message' => 'success'
            ],200);
        }catch (Exception $exception){
            Log::error('Message: '.$exception->getMessage() . 'Line' . $exception->getLine());
            return response()->json([
                'code' =>500,
                'message' => 'fail'
            ],500);
        }
    }
}
