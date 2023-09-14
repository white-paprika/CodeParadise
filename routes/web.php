<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\SaleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ########################### Auth & Home ######## //  
// Auth
Auth::routes(['verify' => true]);
// /
Route::get('/',  function(){
    return redirect()->route('home');
});
// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ########################### Books ######## //  
// Books Index 
Route::get('/books', [BookController::class, 'index'])->name('books.index');
// Books Show  
Route::get('/books/{book}', [BookController::class, 'show'])->where('book', '\d+')->name('books.show');


// ########################### Authorization required ######## //  
Route::middleware(['auth', 'verified'])->group(function (){
    
    Route::middleware(['user'])->group(function () {
        // Comments Store
        Route::post('/books/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
        // Cart Index
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        // Add to cart
        Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
        // Update cart (increase/reduce item quantity)
        Route::patch('/update-cart-item-quantity/{id}', [CartController::class, 'updateItemQuantity'])->name('update_cart_item_quantity');
        // Removing item from cart
        Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeItem'])->name('remove_from_cart');

        // Stripe Checkout 
        Route::get('/checkout', [StripeController::class, 'checkout'])->name('stripe_checkout');
        // Stripe Success
        Route::get('/success', [StripeController::class, 'success'])->name('stripe_success');
        // Stripe Cancel
        Route::get('/cancel', [StripeController::class, 'cancel'])->name('stripe_cancel');
    });

    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->middleware('admin')->name('admin.')->group(function() {
        // Books Index (Admin)
        Route::get('/books', [AdminBookController::class, 'index'])->name('books.index');
        // Books Create
        Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
        // Books Store
        Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');
        // Books Edit 
        Route::get('/books/{book}/edit', [AdminBookController::class, 'edit'])->where('book', '\d+')->name('books.edit');
        // Books Update
        Route::patch('/books/{book}', [AdminBookController::class, 'update'])->where('book', '\d+')->name('books.update');
        // Books Destroy 
        Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->where('book', '\d+')->name('books.destroy');
        // Sales Index
        Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
        
        // Query 1
        Route::get('/queries/1', [QueryController::class, 'query1'])->name('query_1');
        // Query 2
        Route::get('/queries/2', [QueryController::class, 'query2'])->name('query_2');
        // Query 3
        Route::get('/queries/3', [QueryController::class, 'query3'])->name('query_3');
        // Query 4
        Route::get('/queries/4', [QueryController::class, 'query4'])->name('query_4');
        // Query 5
        Route::get('/queries/5', [QueryController::class, 'query5'])->name('query_5');
        // Query 6
        Route::get('/queries/6', [QueryController::class, 'query6'])->name('query_6');
        // Query 7
        Route::get('/queries/7', [QueryController::class, 'query7'])->name('query_7');
        // Query 8
        Route::get('/queries/8', [QueryController::class, 'query8'])->name('query_8');
        // Query 9
        Route::get('/queries/9', [QueryController::class, 'query9'])->name('query_9');
        // Query 10
        Route::get('/queries/10', [QueryController::class, 'query10'])->name('query_10');
        
    });
});

// Middleware in controllers

// Authorize in requests
// Email verification + verify middleware
