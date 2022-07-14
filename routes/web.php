<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;

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


Route::get('materials/search', [MaterialController::class,'searchMaterial'])->name('searchMaterial');
Route::post('materials/addtags', [MaterialController::class, 'addTagMaterial'])->name('addTagMaterial');
Route::post('materials/deletetags', [MaterialController::class, 'deleteTagMaterial'])->name('deleteTagMaterial');

Route::post('materials/addlinks', [MaterialController::class, 'addLinkMaterial'])->name('addLinkMaterial');
Route::post('materials/editlinks', [MaterialController::class, 'editLinkMaterial'])->name('editLinkMaterial');
Route::post('materials/deletelinks', [MaterialController::class, 'deleteLinkMaterial'])->name('deleteLinkMaterial');


Route::resources([
    'materials' => MaterialController::class,
    'tags' => TagController::class,
    'categories' => CategoryController::class,
]);
