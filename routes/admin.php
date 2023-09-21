<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\SettingController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth','checkLogin'])->group(function () {
            Route::get('/',[MainController::class,'index'])->name('index');
            Route::get('/users/all',[MainController::class,'getAllUsers'])->name('users.all');
            Route::resource('settings', SettingController::class);
            Route::resource('/categories',CategoryController::class);
            Route::resource('/posts',PostController::class);
            Route::resource('/tags',TagController::class);
            Route::resource('/users',UserController::class)->except('show');
            Route::post('/users/delete', [UserController::class, 'destroy'])->name('users.delete');

    });
});