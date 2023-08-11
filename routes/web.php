<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', function(){
    return view('home');})->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/',['as' => 'login','uses' =>'AdminController@loginAdmin']);
    Route::post('/', 'AdminController@postLoginAdmin');
    Route::get('/logout',['as' => 'logout','uses' => 'AdminController@logOutAdmin']);
    Route::prefix('/categories')->group( function(){
        Route::get('/',['as' => 'categories.index','uses' => 'CategoryController@index','middleware' => 'can:category-list']);
        Route::get('/create',['as' => 'categories.create','uses' => 'CategoryController@create']);
        Route::post('/store',['as' => 'categories.store','uses' => 'CategoryController@store']);
        Route::get('/edit/{id}',['as' => 'categories.edit','uses' => 'CategoryController@edit']);
        Route::post('/update/{id}',['as' => 'categories.update','uses' => 'CategoryController@update']);
        Route::get('/delete/{id}',['as' => 'categories.delete','uses' => 'CategoryController@delete']);
    });
    Route::prefix('/menu')->group( function(){
        Route::get('/',['as' => 'menus.index','uses' => 'MenuController@index']);
        Route::get('/create',['as' => 'menus.create','uses' => 'MenuController@create']);
        Route::post('/store',['as' => 'menus.store','uses' => 'MenuController@store']);
        Route::get('/edit/{id}',['as' => 'menus.edit','uses' => 'MenuController@edit']);
        Route::post('/update/{id}',['as' => 'menus.update','uses' => 'MenuController@update']);
        Route::get('/delete/{id}',['as' => 'menus.delete','uses' => 'MenuController@delete']);
    });

    Route::prefix('product')->group( function(){
        Route::get('/',['as' => 'product.index','uses' => 'AdminProductController@index']);
        Route::get('/create',['as' => 'product.create','uses' => 'AdminProductController@create']);
        Route::post('/store',['as' => 'product.store','uses' => 'AdminProductController@store']);
        Route::get('/edit/{id}',['as' => 'product.edit','uses' => 'AdminProductController@edit']);
        Route::post('/update/{id}',['as' => 'product.update','uses' => 'AdminProductController@update']);
        Route::get('/delete/{id}',['as' => 'product.delete','uses' => 'AdminProductController@delete']);
    });
    Route::prefix('slider')->group( function(){
        Route::get('/',['as' => 'slider.index','uses' => 'SliderController@index']);
        Route::get('/create',['as' => 'slider.create','uses' => 'SliderController@create']);
        Route::post('/store',['as' => 'slider.store','uses' => 'SliderController@store']);
        Route::get('/edit/{id}',['as' => 'slider.edit','uses' => 'SliderController@edit']);
        Route::post('/update/{id}',['as' => 'slider.update','uses' => 'SliderController@update']);
        Route::get('/delete/{id}',['as' => 'slider.delete','uses' => 'SliderController@delete']);
    });
    Route::prefix('settings')->group( function(){
        Route::get('/',['as' => 'settings.index','uses' => 'SettingController@index']);
        Route::get('/create',['as' => 'settings.create','uses' => 'SettingController@create']);
        Route::post('/store',['as' => 'settings.store','uses' => 'SettingController@store']);
        Route::get('/edit/{id}',['as' => 'settings.edit','uses' => 'SettingController@edit']);
        Route::post('/update/{id}',['as' => 'settings.update','uses' => 'SettingController@update']);
        Route::get('/delete/{id}',['as' => 'settings.delete','uses' => 'SettingController@delete']);
    });
    Route::prefix('users')->group( function(){
        Route::get('/',['as' => 'users.index','uses' => 'AdminUserController@index']);
        Route::get('/create',['as' => 'users.create','uses' => 'AdminUserController@create']);
        Route::post('/store',['as' => 'users.store','uses' => 'AdminUserController@store']);
        Route::get('/edit/{id}',['as' => 'users.edit','uses' => 'AdminUserController@edit']);
        Route::post('/update/{id}',['as' => 'users.update','uses' => 'AdminUserController@update']);
        Route::get('/delete/{id}',['as' => 'users.delete','uses' => 'AdminUserController@delete']);
    });
    Route::prefix('roles')->group(function(){
        Route::get('/',['as' => 'roles.index','uses' => 'AdminRoleController@index']);
        Route::get('/create',['as' => 'roles.create','uses' => 'AdminRoleController@create']);
        Route::post('/store',['as' => 'roles.store','uses' => 'AdminRoleController@store']);
        Route::get('/edit/{id}',['as' => 'roles.edit','uses' => 'AdminRoleController@edit']);
        Route::post('/update/{id}',['as' => 'roles.update','uses' => 'AdminRoleController@update']);
    });
    Route::prefix('roles')->group(function(){
        Route::get('/',['as' => 'roles.index','uses' => 'AdminRoleController@index']);
        Route::get('/create',['as' => 'roles.create','uses' => 'AdminRoleController@create']);
        Route::post('/store',['as' => 'roles.store','uses' => 'AdminRoleController@store']);
        Route::get('/edit/{id}',['as' => 'roles.edit','uses' => 'AdminRoleController@edit']);
        Route::post('/update/{id}',['as' => 'roles.update','uses' => 'AdminRoleController@update']);
    });
    Route::prefix('permissions')->group(function(){
        Route::get('/create',['as' => 'permissions.create','uses' => 'AdminPermissionController@create']);
        Route::post('/store',['as' => 'permissions.store','uses' => 'AdminPermissionController@store']);
        // Route::get('/edit/{id}',['as' => 'roles.edit','uses' => 'AdminRoleController@edit']);
        // Route::post('/update/{id}',['as' => 'roles.update','uses' => 'AdminRoleController@update']);
    });
});

// Route::get('/test',function (){
//     return view('welcome');
// })->name('test');




