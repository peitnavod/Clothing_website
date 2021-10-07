<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;
class SliderAdminController extends Controller
{
    private $slider;
    use StorageImageTrait;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index(){
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
    public function create(){
        return view('admin.slider.add');
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $sliderInsert = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image_path', 'slider');
            if(!empty($dataUploadImage)){
                $sliderInsert['image_name'] = $dataUploadImage['file_name'];
                $sliderInsert['image_path'] = $dataUploadImage['file_path'];
            }
            $this->slider->create($sliderInsert);
            DB::commit();
            return redirect()->route('sliders.index');

        }catch (Exception $exception )
        {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '+ Line: ' . $exception->getLine());
        }
    }
    public function edit($id){
        $slider = $this->slider->find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update($id, Request $request){
        try{
            $sliderUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image_path', 'slider');
            if(!empty($dataUploadImage)){
                $sliderUpdate['image_name'] = $dataUploadImage['file_name'];
                $sliderUpdate['image_path'] = $dataUploadImage['file_path'];
            }
            $this->slider->find($id)->update($sliderUpdate);
            return redirect()->route('sliders.index');
        }catch (Exception $exception )
        {
            Log::error('Message: ' . $exception->getMessage() . '+ Line: ' . $exception->getLine());
        }
    }
    public function delete($id){
        try {
            $this->slider->find($id)->delete();
            return response()->json([
                'code' =>200,
                'message' => 'success'
            ],200);
        }catch (\mysql_xdevapi\Exception $exception){
            Log::error('Message: '.$exception->getMessage() . 'Line' . $exception->getLine());
            return response()->json([
                'code' =>500,
                'message' => 'fail'
            ],500);
        }
    }
}
