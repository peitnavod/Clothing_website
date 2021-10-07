<?php
namespace App\Traits;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

trait DeleteModelTrait{
public function  deleteModel($modelName,$id){
    try {
        $modelName->find($id)->delete();
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
