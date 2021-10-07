<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPermissionController extends Controller
{
    private $permissions;
    public function __construct(Permission $permissions)
    {
            $this->permissions = $permissions;
    }

    public function create(){
        return view('admin.permission.add');
    }
    public function store(Request $request){

       $parent = $request->module_parent;
        $permission = $this->permissions->create([
           'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0,
            'key_code'=>''
        ]);
        foreach ($request->module_child as $module_childItem)
        {
            $key_code =  $module_childItem . '_' . $parent;
            $this->permissions->create([
                'name' => Str::upper($key_code)  ,
                'display_name' => Str::upper($key_code),
                'parent_id' => $permission->id,
                'key_code' => $key_code
            ]);
        }


    }
}
