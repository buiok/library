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
    return redirect()->route('materials.index');
});


Route::get('materials/search', 'App\Http\Controllers\MaterialController@searchMaterial')->name('searchMaterial');
Route::post('materials/addtags', 'App\Http\Controllers\MaterialController@addTagMaterial')->name('addTagMaterial');
Route::post('materials/deletetags', 'App\Http\Controllers\MaterialController@deleteTagMaterial')->name('deleteTagMaterial');

Route::post('materials/addlinks', 'App\Http\Controllers\MaterialController@addLinkMaterial')->name('addLinkMaterial');
Route::post('materials/editlinks', 'App\Http\Controllers\MaterialController@editLinkMaterial')->name('editLinkMaterial');
Route::post('materials/deletelinks', 'App\Http\Controllers\MaterialController@deleteLinkMaterial')->name('deleteLinkMaterial');


Route::resources([
    'materials' => 'App\Http\Controllers\MaterialController',
    'tags' => 'App\Http\Controllers\TagController',
    'categories' => 'App\Http\Controllers\CategoryController'
]);
