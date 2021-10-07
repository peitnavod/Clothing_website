<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class AdminUserController extends Controller
{
    private $user;
    private  $role;
    use DeleteModelTrait;
    public function __construct(User $user, Role $role)
    {
        $this->role = $role;
        $this->user = $user;
    }

    public function index(){
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        $roles = $this->role->all();
        return view('admin.user.add',compact('roles'));
    }
    public function store(Request $request){
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name'=>  $request->name,
                'email'=> $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->roleUser()->attach($request->role_id);
            DB::commit();
            return redirect()->route('users.index');

        }catch (\Exception $exception)
        {
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . ' ,Line: '. $exception->getLine());
        }

    }
    public function edit($id){
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $roleOfUser = $user->roleUser;

        return view('admin.user.edit',compact('user','roles','roleOfUser'));
    }
    public function update($id,Request $request){
        try {
            DB::beginTransaction();
             $this->user->find($id)->update([
                'name'=>  $request->name,
                'email'=> $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            $user->roleUser()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');

        }catch (\Exception $exception)
        {
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . ' ,Line: '. $exception->getLine());
        }
    }
    public function delete($id){
        return $this->deleteModel($this->user,$id);
    }
}
