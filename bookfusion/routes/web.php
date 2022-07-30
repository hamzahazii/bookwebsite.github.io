<?php

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
		Route::group([ 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
			Route::get('/author/statusActive', 'AuthorController@statusActive')->name('author.statusActive');
			Route::get('/author/statusDeactive', 'AuthorController@statusDeactive')->name('author.statusDeactive');
			Route::get('/author/deleteAll', 'AuthorController@deleteAll')->name('author.deleteAll');
			Route::put('author/{id}/status', 'AuthorController@status');
			Route::resource('author', 'AuthorController');
			
			Route::get('/category/statusActive', 'CategoryController@statusActive')->name('category.statusActive');
			Route::get('/category/statusDeactive', 'CategoryController@statusDeactive')->name('category.statusDeactive');
			Route::get('/category/deleteAll', 'CategoryController@deleteAll')->name('category.deleteAll');
			Route::put('category/{id}/status', 'CategoryController@status');
			Route::resource('category', 'CategoryController');


			Route::get('/book/statusActive', 'BookController@statusActive')->name('book.statusActive');
			Route::get('/book/statusDeactive', 'BookController@statusDeactive')->name('book.statusDeactive');
			Route::get('/book/deleteAll', 'BookController@deleteAll')->name('book.deleteAll');
			Route::put('book/{id}/status', 'BookController@status');
			Route::resource('book', 'BookController');

			Route::get('/media/statusActive', 'MediaController@statusActive')->name('media.statusActive');
			Route::get('/media/statusDeactive', 'MediaController@statusDeactive')->name('media.statusDeactive');
			Route::get('/media/deleteAll', 'MediaController@deleteAll')->name('media.deleteAll');
			Route::put('media/{id}/status', 'MediaController@status');
			Route::resource('media', 'MediaController');

			Route::get('/team/statusActive', 'TeamController@statusActive')->name('team.statusActive');
			Route::get('/team/statusDeactive', 'TeamController@statusDeactive')->name('team.statusDeactive');
			Route::get('/team/deleteAll', 'TeamController@deleteAll')->name('team.deleteAll');
			Route::put('team/{id}/status', 'TeamController@status');
			Route::resource('team', 'TeamController');

			Route::post('/updatepassword', 'HomeController@update_password')->name('update.password');
			Route::get('/profile', 'HomeController@profile');
			Route::post('/profile/update', 'HomeController@profile_update')->name('profile.update');
		});


/**** FORENTEND DEVELOPMENT ****/
Auth::routes();

Route::get('/contact', 'MainController@contact');
Route::get('/author_detail/{slug}', 'MainController@author_detail');
Route::get('/author', 'MainController@author');
Route::get('/blog', 'MainController@blog');
Route::get('/gallery', 'MainController@gallery');
Route::get('/about', 'MainController@about');
Route::get('/', 'MainController@index');

Route::get('/category/{slug}', 'CategoryController@show')->name('category.show');
Route::get('/book/{slug}', 'BookController@show')->name('book.show');




Route::get('/home', 'HomeController@index')->name('home');
