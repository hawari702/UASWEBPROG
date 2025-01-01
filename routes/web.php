<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PesananController;
use App\Models\Product;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;

// Rute login untuk admin
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Rute Admin yang memerlukan login
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Redirect dashboard ke products
    Route::get('/dashboard', function () {
        return redirect()->route('admin.products.index');
    });

    // Kelola Produk
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Manajemen Admin
    Route::get('/profile', [AdminController::class, 'index'])->name('admin.profile.index');
    Route::get('/profile/create', [AdminController::class, 'create'])->name('admin.profile.create');
    Route::post('/profile', [AdminController::class, 'store'])->name('admin.profile.store');
    Route::get('/profile/{user}/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/{user}', [AdminController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile/{user}', [AdminController::class, 'destroy'])->name('admin.profile.destroy');
});

// Rute publik untuk user (tanpa login)
Route::get('/', [CatalogController::class, 'showCustomerCatalog'])->name('catalog');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/catalog', [CatalogController::class, 'showCustomerCatalog'])->name('catalog.customer');
Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/faq', 'faq')->name('faq');
Route::get('/blog', [CatalogController::class, 'showBlog'])->name('blog');
Route::get('/bautumum', function () {
    $products = Product::where('category', 'umum')->get();
    return view('bautumum', compact('products'));
})->name('bautumum');
Route::get('/bautspecial', function () {
    $products = Product::where('category', 'special')->get();
    return view('bautspecial', compact('products'));
})->name('bautspecial');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::post('/pesanan/checkout', [PesananController::class, 'checkout'])->name('pesanan.checkout');
Route::get('/pesanan/remove/{id}', [PesananController::class, 'remove'])->name('pesanan.remove');
Route::post('/pesanan/clear', [PesananController::class, 'clearCart'])->name('pesanan.clear');
Route::view('/hubungi', 'hubungi')->name('hubungi');

// Rute untuk forgot password dan reset password
Route::middleware('guest')->group(function () {
    Route::get('/admin/forgot-password', [AdminForgotPasswordController::class, 'create'])
        ->name('admin.password.request');
    Route::post('/admin/forgot-password', [AdminForgotPasswordController::class, 'store'])
        ->name('admin.password.email');
    Route::get('/admin/reset-password/{token}', [AdminForgotPasswordController::class, 'resetForm'])
        ->name('admin.password.reset');
    Route::post('/admin/reset-password', [AdminForgotPasswordController::class, 'reset'])
        ->name('admin.password.update');
});

require __DIR__.'/auth.php';