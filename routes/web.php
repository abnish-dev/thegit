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

Route::get('/home/articles', 'ArticleController@show')-> name('articles'); 
Route::get('/home/articles/add', 'ArticleController@addArticle')-> name('articlesAdd'); 
Route::post('/home/articles/add', 'ArticleController@saveArticle')-> name('articlesSave'); 
Route::get('/home/articles/edit/{id}','ArticleController@editArticle')-> name('articlesEdit');
Route::post('/home/articles/edit/{id}','ArticleController@updateArticle')-> name('articlesUpdate');
Route::get('/home/articles/delete/{id}','ArticleController@deleteArticle')-> name('articlesDelete');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


//Route::get('send-mail','UserController@sendEmailToUser');

