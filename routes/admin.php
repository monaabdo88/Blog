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
            // Users Routes Control
            Route::get('/users/all',[UserController::class,'getAllUsers'])->name('users.all');
            Route::post('/users/delete', [UserController::class, 'destroy'])->name('users.delete');
            
            // Categories Routes Control
            Route::get('/categories/all',[CategoryController::class,'getAllCats'])->name('categories.all');
            Route::post('/categories/delete', [CategoryController::class, 'destroy'])->name('categories.delete');
            
            Route::resources([
                'settings'      => SettingController::class,
                'categories'    => CategoryController::class,
                'users'         => UserController::class,
                'posts'         => PostController::class,
                'tags'          => TagController::class
            ]);
    });
});