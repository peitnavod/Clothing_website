<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roleUser(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
    use SoftDeletes;
    public function checkPermissionAccess($permissionCheck){
        // user dang login dc quyen them, sua danh muc , xem menu
        // lay dc cac quyen
        // so danh gia tri dua vao cua route hien tai xem co ton tai trong cac quyen lay duoc hay khong
        $roles = Auth::user()->roleUser;
        foreach ($roles as $roleItem)
        {
            $permissions = $roleItem->permissions; // load cac $permissions qua quan he nhieu nhieu
            if($permissions->contains('key_code',$permissionCheck))
                // check cac permission cua user voi key_code
                // neu trung thi se chay gate tuong ung
            {
                return true;
            }
        }return false;


    }
}
