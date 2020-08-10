<?php
Route::get('kayit-ol',function (){
    return view('register');
});

Route::get('giris', function (){
    return view('login');
});
Route::post('kayit-ol', 'WelcomeController@register');
Route::post('giris', 'WelcomeController@login');
Route::get('cikis-yap', 'WelcomeController@logOut');

Route::get('sepet', 'WelcomeController@sepet');
Route::post('user/cart', 'WelcomeController@addCartItem');
Route::post('user/cart/delete', 'WelcomeController@deleteCartItem');

Route::post('pay', 'PaymentController@creditCard');

Route::get('item', 'PaymentController@cart');

Route::middleware(['user'])->group(function () {
    Route::get('hesabim', 'WelcomeController@myAccountPage');
    Route::post('user/update', 'WelcomeController@userUpdate');
});