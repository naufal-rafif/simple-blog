<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/article/{slug}', [HomeController::class, 'show'])->name('article.detail');
Route::get('/about', function () {
    return view('about');
})->name('about');


require base_path('routes/auth.php');
require base_path('routes/admin.php');
