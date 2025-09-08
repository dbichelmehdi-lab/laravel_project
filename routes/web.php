<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\WishlistController;

use Illuminate\Support\Facades\Route;



Route::get('admin',[AdminController::class,'adminHome']);


Route::get('/', [HomeController::class,'my_home'])->name('home');

Route::get('/category/{id}', [HomeController::class, 'productsByCategory'])->name('category.products');


Route::get('/home', [HomeController::class,'index']);


// Show all categories:    ==========================








Route::get('/add_product', [AdminController::class,'add_product']);

Route::post('/upload_product',[AdminController::class,'upload_product']);

Route::get('/view_product', [AdminController::class,'view_product']);

// Add this route or update your existing route
Route::get('/admin/products', [AdminController::class, 'view_product'])->name('admin.products');

Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

Route::post('/edit_product/{id}',[AdminController::class,'edit_product']);

Route::get('/update_product/{id}',[AdminController::class,'update_product']);


Route::get('/product/{id}', [HomeController::class, 'productDetails'])->name('product.details');



Route::get('view_category',[AdminController::class,'view_category']); 

Route::post('add_category',[AdminController::class,'add_category']);

Route::get('delete_category/{id}',[AdminController::class,'delete_category']);

Route::get('edit_category/{id}',[AdminController::class,'edit_category']);

Route::post('update_category/{id}',[AdminController::class,'update_category']);



// Routes For the cart:===============================


Route::get('/my_cart',[HomeController::class,'my_cart'])->name('my_cart');

Route::post('/add_cart/{id}',[HomeController::class,'add_cart'])->name('add_cart');

Route::put('/update-cart/{id}', [HomeController::class, 'update_cart'])->name('update.cart');

Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');





// New checkout routes:

Route::get('/checkout', [HomeController::class, 'show_checkout'])->name('checkout');
Route::post('/checkout', [HomeController::class, 'process_checkout'])->name('process.checkout');
Route::post('/process-checkout', [HomeController::class, 'process_checkout'])->name('process.checkout');
Route::get('/payment', [HomeController::class, 'payment_page'])->name('payment.page');






// VPS Payment Callbacks (update these)
Route::post('/vps/notification', [HomeController::class, 'vps_notification'])->name('vps.notification');
Route::get('/vps/success', [HomeController::class, 'vps_success'])->name('vps.success');
Route::get('/vps/failure', [HomeController::class, 'vps_failure'])->name('vps.failure');
Route::get('/vps/cancel', [HomeController::class, 'vps_cancel'])->name('vps.cancel');


// Add to routes/web.php temporarily
Route::get('/test-log', function() {
    \Log::info('Test log entry - logging works!');
    return 'Log test complete - check laravel.log';
});





Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
});




// Add these routes


Route::post('/complete-order', [HomeController::class, 'complete_order'])->name('complete.order');
Route::get('/order-success/{orderNumber}', [HomeController::class, 'order_success'])->name('order.success');

// Admin routes (add middleware as needed):

Route::prefix('admin')->group(function() {
    Route::get('/orders', [AdminController::class, 'show_orders'])->name('admin.orders');
    Route::get('/order/{id}', [AdminController::class, 'show_order_details'])->name('admin.order.details');
    Route::post('/order/{id}/update-status', [AdminController::class, 'update_order_status'])->name('admin.order.update');
});



// routes for Payment Gateway: =========================================================================


Route::get('/payment', [HomeController::class, 'payment_page'])->name('payment.page');





Route::get('/payment/success', [HomeController::class, 'payment_success'])->name('payment.success');
Route::get('/payment/failure', [HomeController::class, 'payment_failure'])->name('payment.failure');
Route::get('/payment/cancel', [HomeController::class, 'payment_cancel'])->name('payment.cancel');
Route::post('/payment/callback', [HomeController::class, 'payment_callback'])->name('payment.callback');





    



























Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
