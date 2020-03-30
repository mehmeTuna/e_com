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

//herhangi bir url eslesme olmaz ise bu sayfa goruntulenecek
Route::any('/', 'WelcomeController@index');

Route::get('hakkinda', 'WelcomeController@about');
Route::get('galeri', 'WelcomeController@gallery');

Route::get('404', 'WelcomeController@noPage');

Route::get('yonetim/giris', 'AdminController@loginPage');
Route::post('business/loginData', 'AdminController@login');

Route::post('business/logout', 'AdminController@logout');

Route::middleware(['admin'])->group(function () {
    Route::get('yonetim', 'AdminController@home');
    Route::get('yonetim/anasayfa', 'AdminController@home');
    Route::get('yonetim/logo-slider', 'AdminController@home');
    Route::get('yonetim/galeri', 'AdminController@home');
    Route::get('yonetim/hakkinda', 'AdminController@home');
    Route::get('yonetim/siparisler', 'AdminController@home');
    Route::get('yonetim/urunler', 'AdminController@home');
    Route::get('yonetim/kategoriler', 'AdminController@home');

    Route::post('category/create', 'AdminController@categoryCreate');
    Route::post('category/list', 'AdminController@categoryList');
    Route::post('category/delete', 'AdminController@categoryDelete');

    Route::post('product/create', 'AdminController@productCreate');
    Route::post('product/list', 'AdminController@productList');
    Route::post('product/delete', 'AdminController@productDelete');

    Route::post('galleryupdate', 'AdminController@galleryUpdate');
    Route::post('logoupdate', 'AdminController@logoUpdate');
    Route::post('sliderupdate', 'AdminController@sliderUpdate');
    Route::post('content/ekle', 'AdminController@newAbout');
    Route::post('content/list', 'AdminController@getAbout');
});

Route::get('*', 'WelcomeController@index');