<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DisplayAdsController;
use App\Http\Controllers\DisplayUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

Route::get('/', [AdsController::class, 'indexOther']);
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [DisplayUserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::delete('/dashboard', [DisplayUserController::class, 'delete'])->middleware(['auth', 'verified'])->name('destroy');

Route::get('/dashboard/user', function () {
    return view('indexUser');
})->middleware(['auth', 'verified'])->name('indexUser');

 Route::get('/dashboard', [DisplayUserController::class, 'index'])->middleware(['auth', 'verified','admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard/{user}/edit', [DisplayUserController::class, 'edit'])->middleware(['admin'])->name('users.edit');
    Route::delete('/dashboard/{user}', [DisplayUserController::class, 'destroy'])->middleware(['admin'])->name('users.destroy');
    Route::patch('/dashboard/{user}', [DisplayUserController::class, 'update'])->middleware(['admin'])->name('users.update');
    Route::get('/dashboard/{user}', [DisplayUserController::class, 'show'])->middleware(['admin'])->name('users.show');

    Route::get('/dashboardUser', [DisplayAdsController::class,  'index'])->name('dashboardUser');
    Route::get('/indexUser', [DisplayAdsController::class,  'indexUser'])->name('indexUser');

    Route::middleware([ 'verified'])->group(function () {
        Route::resource('ads', AdsController::class)->names([
            'index' => 'ads.index',
            'create' => 'ads.create',
            'store' => 'ads.store',
            'show' => 'ads.show',
            'edit' => 'ads.edit',
            'update' => 'ads.update',
            'destroy' => 'ads.destroy'
        ]);

        Route::resource('category', CategoryController::class)->middleware(['admin'])->names([
            'index' => 'category.index',
            'create' => 'category.create',
            'store' => 'category.store',
            'show' => 'category.show',
            'edit' => 'category.edit',
            'update' => 'category.update',
            'destroy' => 'category.destroy',
        ]);
    });
});


// Route::get('/create', [AdsController::class,  'create']);

// Route::post('/create', [AdsController::class, 'store'])->name('store');
// Route::get("/User", function () {
//     return view('User');
// });

// Route::get("/PostAdd", function () {
//     return view('PostAdd');
// });

// Route::get("/ListAdd", function () {
//     return view('ListAdd');
// });

require __DIR__.'/auth.php';

// Route::resource('/ads', AdsController::class );
