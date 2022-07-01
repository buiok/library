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

