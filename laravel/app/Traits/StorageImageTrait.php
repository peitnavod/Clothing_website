<?php
namespace App\Traits;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait {
    public function storageTraitUpload($request, $fieldName, $foderName){
        if($request->hasFile($fieldName)){ // kiểm tra request có tồn tại file không
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName(); // truy xuất tên gốc cuar file tại thời điểm tải lên
            $fileExtension = $file->getClientOriginalExtension(); // đuôi file
            $fileNameHash = Str::random(20) . '.' . $fileExtension;// random 20 chữ số + đuôi file
            $filePath = $request->file($fieldName)->storeAs('public/'.$foderName. '/'. Auth::id(),$fileNameHash);
            // lưu vào thư mục : public/tên thư mục/ID ng tạo/ tên file
            return [
                'file_name' => $fileNameOrigin,
                'file_path' =>  Storage::url($filePath)
            ];
        }
       return null;
    }
    public function storageTraitUploadMutilple($file, $foderName){
            $fileNameOrigin = $file->getClientOriginalName(); // truy xuất tên gốc cuar file tại thời điểm tải lên
            $fileExtension = $file->getClientOriginalExtension(); // đuôi file
            $fileNameHash = Str::random(20) . '.' . $fileExtension;// random 20 chữ số + đuôi file
            $filePath = $file->storeAs('public/'.$foderName. '/'. Auth::id(),$fileNameHash);
            // lưu vào thư mục : public/tên thư mục/ID ng tạo/ tên file
            return [
                'file_name' => $fileNameOrigin,
                'file_path' =>  Storage::url($filePath)
            ];
    }
}
