<?php
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
    Route::get('yonetim/icerik', 'AdminController@home');

    Route::post('category/create', 'AdminController@categoryCreate');
    Route::post('category/list', 'AdminController@categoryList');
    Route::get('category/all', 'AdminController@allCategory');
    Route::post('category/delete', 'AdminController@categoryDelete');

    Route::post('product/create', 'AdminController@productCreate');
    Route::get('product/list', 'AdminController@productList');
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