<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleUserController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    public function index(){
        $roles = $this->role->paginate(5);
        return view('admin.role.index',compact('roles'));
    }
    public function create(){
        $permission = $this->permission->where('parent_id',0)->get();
      return view('admin.role.add',compact('permission'));
    }
    public function store(Request $request){
        $role = $this->role->create([
           'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }
    public function edit($id){
        $permission = $this->permission->where('parent_id',0)->get(); // laod cac modul cha
        $role = $this->role->find($id); // tim kiem tole theo id
        $permissionOfRole = $role->permissions; // load cac permission cua role
        return view('admin.role.edit',compact('permission','permissionOfRole','role'));
    }
    public  function  update($id,Request $request){
        $role =  $this->role->find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }

}
