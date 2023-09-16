<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\UserController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
            Route::get('/',[MainController::class,'index'])->name('index');
            Route::get('/show_settings',[MainController::class,'show_settings'])->name('settings');
            Route::patch('/settings/update/{settings_id}',[MainController::class , 'update'])->name('settings.update');
            Route::resource('/categories',CategoryController::class);
            Route::resource('/posts',PostController::class);
            Route::resource('/tags',TagController::class);
            Route::resource('/users',UserController::class);
    });
});