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


Route::get('materials/search', 'App\Http\Controllers\MaterialController@SearchMaterial')->name('searchMaterial');
Route::post('materials/addtags', 'App\Http\Controllers\MaterialController@AddTagMaterial')->name('addTagMaterial');
Route::post('materials/deletetags', 'App\Http\Controllers\MaterialController@DeleteTagMaterial')->name('deleteTagMaterial');

Route::post('materials/addlinks', 'App\Http\Controllers\MaterialController@AddLinkMaterial')->name('addLinkMaterial');
Route::post('materials/editlinks', 'App\Http\Controllers\MaterialController@EditLinkMaterial')->name('editLinkMaterial');
Route::post('materials/deletelinks', 'App\Http\Controllers\MaterialController@DeleteLinkMaterial')->name('deleteLinkMaterial');


Route::resources([
    'materials' => 'App\Http\Controllers\MaterialController',
    'tags' => 'App\Http\Controllers\TagController',
    'categories' => 'App\Http\Controllers\CategoryController'
]);
