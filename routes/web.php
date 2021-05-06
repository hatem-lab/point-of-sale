<?php

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
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users');

//for admins
Route::get('/admins', 'AdminsController@index')->name('admins');
Route::prefix('')->name('admin.')->group(function()
{
    Route::get('/admin/create', 'AdminsController@create')->name('create');
    Route::post('/admin/store', 'AdminsController@store')->name('store');
    Route::get('/admin/edit/{id}', 'AdminsController@edit')->name('edit');
    Route::post('/admin/update/{id}', 'AdminsController@update')->name('update');
    Route::get('/admin/delete/{id}', 'AdminsController@destroy')->name('delete');
});
//for Category
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/product_id/{id}', 'CategoryController@product_id')->name('product_id');
Route::prefix('')->name('category.')->group(function()
{
    Route::get('/category/create', 'CategoryController@create')->name('create');
    Route::post('/category/store', 'CategoryController@store')->name('store');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('edit');
    Route::post('/category/update/{id}', 'CategoryController@update')->name('update');
    Route::get('/category/delete/{id}', 'CategoryController@destroy')->name('delete');
});
//for Product
Route::get('/products/', 'ProductController@index')->name('products');
Route::prefix('')->name('product.')->group(function()
{
    Route::get('/product/create', 'ProductController@create')->name('create');
    Route::post('/product/store', 'ProductController@store')->name('store');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('edit');
    Route::post('/product/update/{id}', 'ProductController@update')->name('update');
    Route::get('/product/delete/{id}', 'ProductController@destroy')->name('delete');
});
//for Client
Route::get('/clients', 'ClientController@index')->name('clients');
Route::prefix('')->name('client.')->group(function()
{
    Route::get('/client/create', 'ClientController@create')->name('create');
    Route::post('/client/store', 'ClientController@store')->name('store');
    Route::get('/client/edit/{id}', 'ClientController@edit')->name('edit');
    Route::post('/client/update/{id}', 'ClientController@update')->name('update');
    Route::get('/client/delete/{id}', 'ClientController@destroy')->name('delete');
    
   
});
//for Order
    Route::get('/client/orders', 'OrderController@index')->name('client.orders');
    Route::get('/client/order/{id}/create', 'OrderController@create')->name('client.order.create');
    Route::post('/client/order/{id}/store', 'OrderController@store')->name('client.order.store');
    Route::get('/client/order/{order}/{client}/edit', 'OrderController@edit')->name('client.order.edit');
    Route::post('/client/order/{order}/{client}/update', 'OrderController@update')->name('client.order.update');
    Route::get('/client/order/{id}/delete', 'OrderController@destroy')->name('client.order.delete');

    Route::get('/client/order/{id}/show', 'OrderController@show')->name('client.order.show');

   


//for dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/{year}', 'DashboardController@getYear');
	
});


