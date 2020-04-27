<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/', function() {
        return view('frontend.app');
});

Route::group(['prefix' => 'admin'], function() {

    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::post('/logout', 'Admin\LoginController@logout')->name('admin.logout'); 
    Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    });
    Route::group(['prefix' => 'brands'], function() {

        Route::get('/', 'Admin\BrandController@index')->name('admin.brand.index');
        Route::get('/create', 'Admin\BrandController@create')->name('admin.brand.create');
        Route::post('/store', 'Admin\BrandController@store')->name('admin.brand.store');
        Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brand.edit');
        Route::post('/update', 'Admin\BrandController@update')->name('admin.brand.update');
        Route::post('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brand.delete');
    });



    Route::group(['prefix' => 'categories'], function() {

        Route::get('/', 'Admin\CategoryController@index')->name('admin.category.index');
        Route::get('/create', 'Admin\CategoryController@create')->name('admin.category.create');
        Route::post('/store', 'Admin\CategoryController@store')->name('admin.category.store');
        Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.category.edit');
        Route::post('/update', 'Admin\CategoryController@update')->name('admin.category.update');
        Route::delete('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.category.delete');
    });




    Route::group(['prefix' => 'attributes'], function() {
        Route::get('/', 'Admin\AttributeController@index')->name('admin.attribute.index');
        Route::get('/create', 'Admin\AttributeController@create')->name('admin.attribute.create');
        Route::post('/store', 'Admin\AttributeController@store')->name('admin.attribute.store');
        Route::get('/{id}/edit', 'Admin\AttributeController@edit')->name('admin.attribute.edit');
        Route::post('/update', 'Admin\AttributeController@update')->name('admin.attribute.update');
        Route::get('/{id}/delete', 'Admin\AttributeController@delete')->name('admin.attribute.delete');

        Route::post('/get-values', 'Admin\AttributeValuesController@getValues');
        Route::post('/add-values', 'Admin\AttributeValuesController@addValues');
        Route::post('/update-values', 'Admin\AttributeValuesController@updateValues');
        Route::post('/delete-values', 'Admin\AttributeValuesController@deleteValues');
    });


    Route::group(['prefix' => 'categories'], function() {

        Route::get('/', 'Admin\CategoryController@index')->name('admin.category.index');
        Route::get('/create', 'Admin\CategoryController@create')->name('admin.category.create');
        Route::post('/store', 'Admin\CategoryController@store')->name('admin.category.store');
        Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.category.edit');
        Route::post('/update', 'Admin\CategoryController@update')->name('admin.category.update');
        Route::delete('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.category.delete');
    });




    Route::group(['prefix' => 'products'], function() {

        Route::get('/', 'Admin\ProductController@index')->name('admin.product.index');
        Route::get('/create', 'Admin\ProductController@create')->name('admin.product.create');
        Route::post('/store', 'Admin\ProductController@store')->name('admin.product.store');
        Route::get('/{id}/edit', 'Admin\ProductController@edit')->name('admin.product.edit');
        Route::post('/update', 'Admin\ProductController@update')->name('admin.product.update');
        Route::delete('/{id}/delete', 'Admin\ProductController@delete')->name('admin.product.delete');


        Route::post('images/upload', 'Admin\ProductImageController@upload')->name('admin.products.images.upload');
Route::get('images/{id}/delete', 'Admin\ProductImageController@delete')->name('admin.products.images.delete');




Route::get('attributes/load', 'Admin\ProductAttributeController@loadAttributes');

Route::post('attributes', 'Admin\ProductAttributeController@productAttributes');

Route::post('attributes/values', 'Admin\ProductAttributeController@loadValues');

Route::post('attributes/add', 'Admin\ProductAttributeController@addAttribute');

Route::post('attributes/delete', 'Admin\ProductAttributeController@deleteAttribute');





    });

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
