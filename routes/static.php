<?php

use App\About;

Route::get('hakkimizda', function (){
    return view('about');
});
Route::get('galeri', function (){
    $about = About::find(1);

    return view('gallery', [
        'data' => $about,
    ]);
});
Route::get('iletisim', 'WelcomeController@about');

Route::get('404', function (){
    return view('404');
});