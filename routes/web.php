<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('search', 'HomeController@search');

Route::get('admin/book', 'AdminController@index')->middleware('auth');
Route::get('admin/book/create', 'AdminController@createBook')->middleware('auth');
Route::post('admin/book/store', 'AdminController@storeBook')->middleware('auth');
Route::get('admin/book/create/author', 'AdminController@createAuthor')->middleware('auth'); 
Route::post('admin/book/store/author', 'AdminController@storeAuthor')->middleware('auth'); 
Route::get('admin/book/create/category', 'AdminController@creatCategory')->middleware('auth'); 
Route::post('admin/book/store/category', 'AdminController@storeCategory')->middleware('auth'); 
Route::get('admin/book/edit/{id}', 'AdminController@edit')->middleware('auth'); 
Route::post('admin/book/update/{id}', 'AdminController@update')->middleware('auth');    
Route::post('admin/book/delete/{id}', 'AdminController@destroy')->middleware('auth'); 
Route::get('admin/book/create/publisher', 'AdminController@create_publisher')->middleware('auth'); 
Route::post('admin/book/store/publisher', 'AdminController@store_publisher')->middleware('auth'); 
Route::get('home', 'HomeController@index');
Route::get('books', 'HomeController@viewBooks');
Route::get('book/author/{id}', 'HomeController@viewAuthorBook');
Route::get('book/publisher/{id}', 'HomeController@viewPublisherBook');
Route::get('book/category/{id}', 'HomeController@viewCategoryBook');
Route::get('book/{id}', 'HomeController@viewBook');
Route::get('view/authors', 'HomeController@viewAuthors');
Route::get('view/categories', 'HomeController@viewCategories');
Route::get('view/publishers', 'HomeController@viewPublishers');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
