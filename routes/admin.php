<?php

use App\Http\Controllers\Admin\Article\ArticleController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Tag\TagController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard.home');

    Route::group(['prefix' => 'articles'], function () {
        Route::get('/temp', [ArticleController::class, 'temp'])->name('dashboard.articles.temp');
        Route::post('/delete/{id}', [ArticleController::class, 'delete'])->name('dashboard.articles.delete');
        Route::post('/deleteMultiple', [ArticleController::class, 'deleteMultiple'])->name('dashboard.articles.deleteMultiple');
        Route::post('/recover/{id}', [ArticleController::class, 'recover'])->name('dashboard.articles.recover');
        Route::post('/recoverMultiple', [ArticleController::class, 'recoverMultiple'])->name('dashboard.articles.recoverMultiple');
        Route::post('/destroyMultiple', [ArticleController::class, 'destroyMultiple'])->name('dashboard.articles.destroyMultiple');
        Route::put('/updateStatus/{id}', [ArticleController::class, 'updateStatus'])->name('dashboard.articles.updateStatus');
    });

    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);

    Route::group(['middleware' => ['role:admin']], function () {
        // khusus untuk admin
        // 1. route untuk permission
        // 2. route untuk maintain user
    });
});

// Route::group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers\Api'], function () {
//     Route::group(['prefix' => 'v1', 'middleware' => ['auth']], function () {
//     });
// });
