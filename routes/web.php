<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

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

/* =============== Admin ============= */

Route::group(['prefix' => 'admin'], function () {
    Route::get('/show/login/form',[AdminController::class,'index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class,'login'])->name('admin.sign-in');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/dashboard/logout',[AdminController::class,'logout'])->name('admin.logout');
});

Route::group(['middleware' => ['admin']], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('/manage',[CategoryController::class,'manage'])->name('category.manage');
        Route::get('/show/form',[CategoryController::class,'show'])->name('category.add');
        Route::post('/store/data',[CategoryController::class,'store'])->name('category.store');
        Route::get('/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
        Route::get('/edit/{id}',[CategoryController::class,'editCategory'])->name('category.edit');
        Route::post('/update',[CategoryController::class,'updateCategory'])->name('category.update');
        Route::get('/publish/{id}',[CategoryController::class,'publish'])->name('category.publish');
        Route::get('/hide/{id}',[CategoryController::class,'hide'])->name('category.hide');
    });

    Route::group(['prefix' => 'post'], function () {
        Route::resource('post', PostController::class);
        Route::get('/destroy/{id}',[PostController::class,'destroy'])->name('post.delete');
        Route::get('/publish/{id}',[PostController::class,'publish'])->name('post.publish');
        Route::get('/hide/{id}',[PostController::class,'hide'])->name('post.hide');
        Route::post('/content/file',[PostController::class,'fileUpload'])->name('post.content_file');
    });
});



/* =============== Admin ============= */




/* =============== User ============= */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/* =============== User ============= */


