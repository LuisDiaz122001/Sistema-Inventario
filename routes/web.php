<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

use App\Models\Category;
use App\Models\Product;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'stats' => [
            'categories' => Category::count(),
            'products' => Product::count(),
            'total_stock' => Product::sum('stock'),
            'total_value' => Product::sum(\Illuminate\Support\Facades\DB::raw('price * stock')),
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::middleware('role:Administrador')->group(function () {
        Route::resource('users', \App\Http\Controllers\UserController::class);
    });
});

require __DIR__.'/auth.php';
