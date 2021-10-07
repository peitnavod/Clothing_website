<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', 'App\Http\Controllers\AdminController@loginAdmin');

Route::post('/admin', 'App\Http\Controllers\AdminController@postLoginAdmin');

Route::get('/home', function () {
    return view('home');
});
Route::prefix('admin')->group(function (){
    Route::prefix('categories')->group(function (){
        Route::get('/',[
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::get('/create',[
            'as' => 'categories.create',
                'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store',

        ]);
        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update',
        ]);
        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);
    });
    Route::prefix('menus')->group(function (){
        Route::get('/',[
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware' => 'can:menu-list'
        ]);
        Route::get('/create',[
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create'
        ]);
        Route::post('/store',[
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete'
        ]);
    });

    // slider
    Route::prefix('sliders')->group(function (){
        Route::get('/',[
            'as' => 'sliders.index',
            'uses' => 'App\Http\Controllers\SliderAdminController@index',
            'middleware' =>'can:list-slider'
        ]);
        Route::get('/create',[
            'as' => 'sliders.create',
            'uses' => 'App\Http\Controllers\SliderAdminController@create'
        ]);
        Route::post('/store',[
            'as' => 'sliders.store',
            'uses' => 'App\Http\Controllers\SliderAdminController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'sliders.edit',
            'uses' => 'App\Http\Controllers\SliderAdminController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'sliders.update',
            'uses' => 'App\Http\Controllers\SliderAdminController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'sliders.delete',
            'uses' => 'App\Http\Controllers\SliderAdminController@delete'
        ]);

    });
    //setting
    Route::prefix('settings')->group(function (){
        Route::get('/',[
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\SettingAdminController@index',
            'middleware' => 'can:list-setting'
        ]);
        Route::get('/create',[
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\SettingAdminController@create',
            'middleware' => 'can:add-setting'
        ]);
        Route::post('/store',[
            'as' => 'settings.store',
            'uses' => 'App\Http\Controllers\SettingAdminController@store',
            'middleware' => 'can:add-setting'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\SettingAdminController@edit',
            'middleware' => 'can:edit-setting'
        ]);
       Route::post('/update/{id}',[
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\SettingAdminController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\SettingAdminController@delete',
            'middleware' => 'can:delete-setting'
        ]);
    });
    //user
    Route::prefix('users')->group(function (){
        Route::get('/',[
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\AdminUserController@index'
        ]);
        Route::get('/create',[
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\AdminUserController@create'
        ]);
        Route::post('/store',[
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\AdminUserController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\AdminUserController@delete'
        ]);
    });
    //role
    Route::prefix('roles')->group(function (){
        Route::get('/',[
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\AdminRoleUserController@index'
        ]);
        Route::get('/create',[
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\AdminRoleUserController@create'
        ]);
        Route::post('/store',[
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\AdminRoleUserController@store'
        ]);
        Route::get('/eit/{id}',[
            'as' => 'roles.edit',
            'uses' => 'App\Http\Controllers\AdminRoleUserController@edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\AdminRoleUserController@update'
        ]);
    });
    //permission
    Route::prefix('permissions')->group(function (){
        Route::get('/',[
            'as' => 'permissions.create',
            'uses' => 'App\Http\Controllers\AdminPermissionController@create'
        ]);
        Route::post('/',[
            'as' => 'permissions.store',
            'uses' => 'App\Http\Controllers\AdminPermissionController@store'
        ]);

    });
});



