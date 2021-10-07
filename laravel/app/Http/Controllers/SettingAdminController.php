<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequestSetting;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class SettingAdminController extends Controller
{
    private $setting;
    use DeleteModelTrait;
    public function __construct(Setting  $setting)
    {
        $this->setting = $setting;
    }

    public function index(){
        $settings = $this->setting->latest()->paginate(5);
        return view('admin.setting.index',compact('settings'));
    }
    public function create(){
        return view('admin.setting.add');
    }
    public function store(AddRequestSetting $request){

          $this->setting->create([
             'config_key'=>$request->config_key,
              'config_value'=>$request->config_value,
              'type' =>$request->type
          ]);
          return redirect()->route('settings.index');
    }
    public function edit($id){
        $setting = $this->setting->find($id);
        return view('admin.setting.edit',compact('setting'));
    }
    public function update($id,Request $request){
        $setting = $this->setting->find($id);
        if($setting->config_key == $request->config_key)
        {
                $setting->update(['config_value'=>$request->config_value,]);
        }
        else
        {
            $setting->update([
                'config_key'=>$request->config_key,
                'config_value'=>$request->config_value

            ]);
        }
        return redirect()->route('settings.index');
    }

    public function delete($id){
        return $this->deleteModel($this->setting,$id);
    }
}
