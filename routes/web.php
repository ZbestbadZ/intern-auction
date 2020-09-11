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

Auth::routes();

Route::group(['prefix'=>'/auctions'],function(){
    
    Route::patch('/{id}','AuctionController@update')->name('auctions.update');

});

Route::group(['prefix'=>'/products', 'middleware' => ['isadmin']],function(){
    Route::get('', 'ProductController@index')->name('products.index');

    Route::post('', 'ProductController@store');

    Route::get('/create', 'ProductController@create')->name('products.create');

    Route::get('/{id}/edit','ProductController@edit')->name('products.edit');

    Route::patch('/{id}','ProductController@update')->name('products.update');

    Route::get('/{id}', 'ProductController@show')->name('products.show');

    Route::delete('/{id}','ProductController@destroy')->name('products.destroy');    
});

Route::group(['prefix'=>'productImage','middleware' => ['isadmin']] , function(){
    Route::delete('/{id}','ProductImageController@destroy')->name('productImage.destroy'); 
});

Route::get('admin', ['middleware' => 'isadmin', function () {
    return view('admin.admin');
}]);

Route::group(['prefix'=>'user', 'middleware' => 'auth'], function(){
    Route::get('list_product', 'UserController@getList_product')->name('user.list_product');
    Route::get('products/{id}', 'UserController@getShow');
    Route::patch('products/{id}', 'UserController@postAuction');
});
