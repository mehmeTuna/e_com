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

Route::get('pdf', 'AdminController@ordersInvoice');
Route::get('excel', 'Admincontroller@excel');

Route::get('hakkimizda', 'WelcomeController@about');
Route::get('galeri', 'WelcomeController@gallery');
Route::get('iletisim', 'WelcomeController@about');

Route::get('404', 'WelcomeController@noPage');

Route::get('kayit-ol', 'WelcomeController@registerPage');
Route::post('kayit-ol', 'WelcomeController@register');

Route::get('giris', 'WelcomeController@loginPage');
Route::post('giris', 'WelcomeController@login');

Route::get('cikis-yap', 'WelcomeController@logOut');

Route::get('yonetim/giris', 'AdminController@loginPage');
Route::post('business/loginData', 'AdminController@login');
Route::post('business/logout', 'AdminController@logout');

Route::get('ara/{search}', 'WelcomeController@search');
Route::get('sepet', 'WelcomeController@sepet');
Route::post('user/cart', 'WelcomeController@addCartItem');
Route::post('user/cart/delete', 'WelcomeController@deleteCartItem');

Route::post('pay', 'PaymentController@creditCard');

Route::get('item', 'PaymentController@cart');

Route::middleware(['user'])->group(function () {
    Route::get('hesabim', 'WelcomeController@myAccountPage');
    Route::post('user/update', 'WelcomeController@userUpdate');
});

Route::prefix('icerik')->group(function(){
    Route::get('/', 'WelcomeController@articleList');
    Route::get('{slug}', 'WelcomeController@showArticle');
});

Route::prefix('v1')->group(function(){
    Route::get('blogs', 'WelcomeController@blogs');
    Route::post('blog', 'WelcomeController@blogCreate');
    Route::delete('blog/{id}', 'WelcomeController@blogDelete');
});

Route::middleware(['admin'])->group(function () {
    Route::get('yonetim', 'AdminController@home');
    Route::get('yonetim/anasayfa', 'AdminController@home');
    Route::get('yonetim/logo-slider', 'AdminController@home');
    Route::get('yonetim/galeri', 'AdminController@home');
    Route::get('yonetim/hakkinda', 'AdminController@home');
    Route::get('yonetim/siparisler', 'AdminController@home');
    Route::get('yonetim/urunler', 'AdminController@home');
    Route::get('yonetim/kategoriler', 'AdminController@home');
    Route::get('yonetim/icerik', 'AdminController@home');

    Route::post('category/create', 'AdminController@categoryCreate');
    Route::post('category/list', 'AdminController@categoryList');
    Route::get('category/all', 'AdminController@allCategory');
    Route::post('category/delete', 'AdminController@categoryDelete');

    Route::post('product/create', 'AdminController@productCreate');
    Route::post('product/list', 'AdminController@productList');
    Route::post('product/delete', 'AdminController@productDelete');

    Route::get('orders', 'AdminController@getOrders');
    Route::delete('orders', 'AdminController@orderDelete');
    Route::post('orders/update', 'AdminController@orderConfirmation');

    Route::post('galleryupdate', 'AdminController@galleryUpdate');
    Route::post('logoupdate', 'AdminController@logoUpdate');
    Route::post('sliderupdate', 'AdminController@sliderUpdate');
    Route::post('content/ekle', 'AdminController@newAbout');
    Route::post('content/list', 'AdminController@getAbout');
});

Route::get('{sLugName}', 'WelcomeController@showPage');

Route::get('*', 'WelcomeController@index');