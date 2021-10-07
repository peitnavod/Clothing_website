<?php

namespace App\Providers;

use App\Models\Product;
use App\Services\PermissionGateAndPolicyAccess;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //checkPermissionAccess o trong model User
        //permissions file dc viet trong config
        //permissions.access.list-category truy cap den file va ten tuong ung

        // phan quyen xem category
        //policy
        $PermissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $PermissionGateAndPolicy->setPermissionGateAndPolicy();
        // gate
      /* Gate::define('category-list', function ($user) {
           return $user->checkPermissionAccess(config('permissions.access.list-category'));
           //category-list: ten gate
            //config('permissions.access.list-category') truyen ten key_code de so sanh
        });
        // them
        Gate::define('category-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-category'));
        });
        //sua
        Gate::define('category-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-category'));
        });
        //xoa
        Gate::define('category-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-category'));
        });*/
        // phan quyen xem menu
        Gate::define('menu-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-menu'));
        });
        // phan quyen xem product
        Gate::define('list-product', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-product'));
        });
        // sua
        Gate::define('product-edit', function ($user,$id) {
            //id la id cua san pham
            $product = Product::find($id);
            $result = $user->checkPermissionAccess(config('permissions.access.edit-product'));
            if($result && $user->id == $product->user_id)
            {
                return true;
            }
            return false;
        });
        // phan quyen xem slider
        Gate::define('list-slider', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-slider'));
        });
        // phan quyen  setting
        //xem
        Gate::define('list-setting', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-setting'));
        });
        //them
        Gate::define('add-setting', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-setting'));
        });
        //sua
        Gate::define('edit-setting', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-setting'));
        });
        //xoa
        Gate::define('delete-setting', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-setting'));
        });
    }

}
