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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'/product'],function(){
    Route::get('', 'ProductController@index')->name('product.index');

    Route::post('', 'ProductController@store');

    Route::get('/create', 'ProductController@create')->name('product.create');

    Route::get('/{product}/edit','ProductController@edit')->name('product.edit');

    Route::patch('/{product}','ProductController@update')->name('product.update');

    Route::get('/{product}', 'ProductController@show')->name('product.show');

    Route::delete('/{product}','ProductController@destroy')->name('product.destroy');    
});



