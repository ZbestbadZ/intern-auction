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

Route::group(['prefix'=>'/products'],function(){
    Route::get('', 'ProductController@index')->name('products.index');

    Route::post('', 'ProductController@store');

    Route::get('/create', 'ProductController@create')->name('products.create');

    Route::get('/{id}/edit','ProductController@edit')->name('products.edit');

    Route::patch('/{id}','ProductController@update')->name('products.update');

    Route::get('/{id}', 'ProductController@show')->name('products.show');

    Route::delete('/{id}','ProductController@destroy')->name('products.destroy');    
});

Route::get('admin', ['middleware' => 'isadmin', function () {
    return view('admin.admin');
}]);

Route::get('user',['middleware' => 'auth', function () {
    return view('user.user');
}]);


