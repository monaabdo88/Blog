<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\Dashboard\UsersController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
            Route::get('/',[MainController::class,'index'])->name('index');
            Route::get('/show_settings',[MainController::class,'show_settings'])->name('settings');
            Route::post('updateSettings/{settings_id}',[MainController::class , 'updateSettings'])->name('updateSettings');
            Route::resource('/categories',CategoriesController::class);
            Route::resource('/posts',PostsController::class);
            Route::resource('/tags',PostsController::class);
            Route::resource('/users',PostsController::class);
    });
});