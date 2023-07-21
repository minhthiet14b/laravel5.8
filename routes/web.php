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
    return view('home');})->name('home')->middleware('auth');
Route::prefix('admin')->group(function(){
    Route::get('/','AdminController@loginAdmin');
    Route::post('/', 'AdminController@postLoginAdmin');
    Route::prefix('/categories')->group( function(){
        Route::get('/',['as' => 'categories.index','uses' => 'CategoryController@index']);
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
});

// Route::get('/test',function (){
//     return view('welcome');
// })->name('test');




