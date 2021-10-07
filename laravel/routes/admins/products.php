<?php
// san pham
Route::prefix('products')->group(function (){
    Route::get('/index',[
        'as' => 'product.index',
        'uses' => 'App\Http\Controllers\AdminProductController@index',
        'middleware' => 'can:list-product'
    ])->withTrashed();
    Route::get('/create',[
        'as' => 'product.create',
        'uses' => 'App\Http\Controllers\AdminProductController@create'
    ]);
    Route::post('/store',[
        'as' => 'product.store',
        'uses' => 'App\Http\Controllers\AdminProductController@store'
    ]);
    Route::get('/edit/{id}',[
        'as' => 'product.edit',
        'uses' => 'App\Http\Controllers\AdminProductController@edit',
        'middleware' =>'can:product-edit,id'
    ]);
    Route::post('/update/{id}',[
        'as' => 'product.update',
        'uses' => 'App\Http\Controllers\AdminProductController@update'
    ]);
    Route::get('/delete/{id}',[
        'as' => 'product.delete',
        'uses' => 'App\Http\Controllers\AdminProductController@delete'
    ]);
});
