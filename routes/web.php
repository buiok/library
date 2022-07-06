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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('materials', 'App\Http\Controllers\MaterialController');
Route::post('materials/addtags', 'App\Http\Controllers\MaterialController@AddTagMaterial')->name('addTagMaterial');
Route::post('materials/deletetags', 'App\Http\Controllers\MaterialController@DeleteTagMaterial')->name('deleteTagMaterial');

Route::resource('tags', 'App\Http\Controllers\TagController');

Route::resource('categories', 'App\Http\Controllers\CategoryController');

Route::post('materials/addlinks', 'App\Http\Controllers\MaterialController@AddLinkMaterial')->name('addLinkMaterial');
Route::post('materials/editlinks', 'App\Http\Controllers\MaterialController@EditLinkMaterial')->name('editLinkMaterial');
Route::post('materials/deletelinks', 'App\Http\Controllers\MaterialController@DeleteLinkMaterial')->name('deleteLinkMaterial');
