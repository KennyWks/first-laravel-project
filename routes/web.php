<?php

use App\Models\User;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
    return view('home', [
        "title" => "Home",
        "active" => "about",
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about",
        "name" => "Kenny",
        "email" => "kenny.peulu@gmail.com",
        "img" => "kenny.JPG",
    ]);
});

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/article/{articleModel:slug}', [ArticleController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/categories/{categoryModel:slug}', [CategoryController::class, 'show']);

// Route::get('/authors/{author:username}', function(User $author){
//     return view('articles', [
//         "title" => $author->name,
//         "active" => "auhors",
//         "rows" => $author->articleModel->load('categoryModel', 'author'),
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

