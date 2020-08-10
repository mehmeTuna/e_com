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
require_once 'user.php';
require_once 'static.php';
require_once 'admin.php';

//herhangi bir url eslesme olmaz ise bu sayfa goruntulenecek
Route::any('/', 'WelcomeController@index');

Route::get('ara/{search}', 'WelcomeController@search');

Route::prefix('blog')->group(function(){
    Route::get('/', 'WelcomeController@articleList');
    Route::get('{slug}', 'WelcomeController@showArticle');
});

Route::prefix('v1')->group(function(){
    Route::get('blogs', function (){
        $blogs = \App\Blogs::active()->orderBy('created_at', 'ASC')->get();
        return response()->json($blogs);
    });
    Route::post('blog', 'WelcomeController@blogCreate');
    Route::delete('blog/{id}', 'WelcomeController@blogDelete');
});

Route::get('{sLugName}', 'WelcomeController@showPage');

Route::get('*', 'WelcomeController@index');