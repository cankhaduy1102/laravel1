<?php
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['web']], function () {
    Route::get('/','ProductController@admin')->name('admin');
    Route::get('/{id}/remove','ProductController@delete')->name('product.remove');
    Route::get('/add','ProductController@addProduct')->name('product.add');
    Route::post('/add','ProductController@saveProduct')->name('product.saveAdd');
    Route::get('/edit','ProductController@editForm')->name('product.edit');
    Route::post('/edit','ProductController@saveEdit')->name('product.saveEdit');
    Route::get('categories','CategoryController@index')->name('cate.index');
    Route::get('categories/add','CategoryController@add')->name('cate.add');
    Route::post('categories/add','CategoryController@saveAdd')->name('saveAdd');
    Route::get('categories/edit/{id}','CategoryController@edit')->name('cate.edit');
    Route::post('categories/edit/{id}','CategoryController@saveEdit');
    Route::get('categories/{id}/remove', 'CategoryController@delete')->name('cate.remove');
    Route::get('search','CategoryController@search')->name('search');









});





?>