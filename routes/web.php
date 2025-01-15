<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingCart;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rolemanager:user'])->name('dashboard');




Route::get('/products', [ProductController::class, 'userindex'])->name('products.index'); // List all products


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::prefix('admin')->middleware(['auth','verified','rolemanager:admin'])->group(function(){
    Route::get('/dashboard',function(){ return view('admin-dashboard');})->name('admin-dashboard'); //dashboard


    // Category Management
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index'); // List all categories
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create'); // Show add category form
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store'); // Save new category
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // Show edit category form
        Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update'); // Update category
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('categories.delete'); // Delete category
    });



        // Product Management
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'adminindex'])->name('products.admin-index'); // List all products
            Route::get('/create', [ProductController::class, 'admincreate'])->name('products.admin-create'); // Show add product form
            Route::post('/store', [ProductController::class, 'adminstore'])->name('products.admin-store'); // Save new product
            Route::get('/{id}/edit', [ProductController::class, 'adminedit'])->name('products.admin-edit'); // Show edit product form
            Route::put('/{id}', [ProductController::class, 'adminupdate'])->name('products.admin-update'); // Update product
            Route::delete('/{id}', [ProductController::class, 'admindestroy'])->name('products.admin-delete'); // Delete product
        });

});




Route::prefix('vendor')->middleware(['auth','verified','rolemanager:vendor'])->group(function(){
    Route::get('/dashboard',function(){ return view('vendor-dashboard');})->name('vendor-dashboard'); //dashboard



    // Product Management
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'vendorindex'])->name('products.vendor-index'); // List all products
            Route::get('/create', [ProductController::class, 'vendorcreate'])->name('products.vendor-create'); // Show add product form
            Route::post('/store', [ProductController::class, 'vendorstore'])->name('products.vendor-store'); // Save new product
            Route::get('/{id}/edit', [ProductController::class, 'vendoredit'])->name('products.vendor-edit'); // Show edit product form
            Route::put('/{id}', [ProductController::class, 'vendorupdate'])->name('products.vendor-update'); // Update product
            Route::delete('/{id}', [ProductController::class, 'vendordestroy'])->name('products.vendor-delete'); // Delete product
        });

});

Route::get('/products-list', [ShoppingCart::class, 'index']); // List all products

Route::get('/cart-list', [ShoppingCart::class, 'ProductCart']); // List all products

Route::get('/add-to-cart', [ShoppingCart::class, 'addProductToCart'])->name('add-product-to-shopping-cart'); // List all products

Route::delete('/delete-cart-item',[ShoppingCart::class, 'deleteItem'])->name('delete.cart.item');




require __DIR__.'/auth.php';
