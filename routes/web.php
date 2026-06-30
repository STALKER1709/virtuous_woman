<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware('throttle:10,1')->group(function () {
    Auth::routes();
});

//Routes racines
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class,'index'])->name('shop.index');
Route::get('/shop/{product_slug}', [ShopController::class,'product_details'])->name('shop.product.details');
Route::post('/shop/{product_slug}/notify-stock', [ShopController::class,'notifyStock'])->middleware('throttle:5,1')->name('shop.product.notify-stock');

//Cart Routes
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class,'add_to_cart'])->name('cart.add');
Route::put('cart/increase-quantity/{rowId}', [CartController::class,'increase_cart_quantity'])->name('cart.qty.increase');
Route::put('cart/decrease-quantity/{rowId}', [CartController::class,'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::delete('cart/remove/{rowId}', [CartController::class,'remove_item'])->name('cart.item.remove');
Route::delete('cart/clear', [CartController::class,'clear_cart'])->name('cart.clear');

//Routes Admin

Route::middleware(['auth', AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
    
    //brands routes
    Route::get('/admin/brands', [AdminController::class,'brands'])->name('admin.brands');
    Route::get('/admin/brand/add', [AdminController::class,'add_brand'])->name('admin.brand.add');
    Route::post('/admin/brand/store', [AdminController::class,'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}', [AdminController::class,'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update', [AdminController::class,'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete', [AdminController::class,'brand_delete'])->name('admin.brand.delete');

    //categories routes
    Route::get('/admin/categories', [AdminController::class,'categories'])->name('admin.categories');
    Route::get('/admin/category/add', [AdminController::class,'category_add'])->name('admin.category.add');
    Route::post('/admin/category/store', [AdminController::class,'category_store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}', [AdminController::class,'category_edit'])->name('admin.category.edit');
    Route::put('/admin/category/update', [AdminController::class,'category_update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [AdminController::class,'category_delete'])->name('admin.category.delete');

    //products routes
    Route::get('/admin/products', [AdminController::class,'products'])->name('admin.products');
    Route::get('/admin/product/add', [AdminController::class,'product_add'])->name('admin.product.add');
    Route::post('/admin/product/store', [AdminController::class,'product_store'])->name('admin.product.store');
    Route::get('/admin/product/{id}/edit', [AdminController::class,'product_edit'])->name('admin.product.edit');
    Route::put('/admin/product/update', [AdminController::class,'product_update'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete', [AdminController::class,'product_delete'])->name('admin.product.delete');
    Route::post('/admin/product/{productId}/variant', [AdminController::class,'variant_store'])->name('admin.product.variant.store');
    Route::delete('/admin/product/{productId}/variant/{variantId}', [AdminController::class,'variant_delete'])->name('admin.product.variant.delete');

    //orders routes
    Route::get('/admin/orders', [AdminController::class,'orders'])->name('admin.orders');
    Route::get('/admin/order/{id}', [AdminController::class,'order_details'])->name('admin.order.details');
    Route::put('/admin/order/{id}/status', [AdminController::class,'order_update_status'])->name('admin.order.status.update');

    //coupons routes
    Route::get('/admin/coupons', [AdminController::class,'coupons'])->name('admin.coupons');
    Route::get('/admin/coupon/add', [AdminController::class,'coupon_add'])->name('admin.coupon.add');
    Route::post('/admin/coupon/store', [AdminController::class,'coupon_store'])->name('admin.coupon.store');
    Route::put('/admin/coupon/{id}/toggle', [AdminController::class,'coupon_toggle'])->name('admin.coupon.toggle');
    Route::delete('/admin/coupon/{id}/delete', [AdminController::class,'coupon_delete'])->name('admin.coupon.delete');

    //reviews moderation
    Route::delete('/admin/review/{id}/delete', [AdminController::class,'review_delete'])->name('admin.review.delete');

    //returns routes
    Route::get('/admin/returns', [AdminController::class,'returns'])->name('admin.returns');
    Route::get('/admin/return/{id}', [AdminController::class,'return_details'])->name('admin.return.details');
    Route::put('/admin/return/{id}/status', [AdminController::class,'return_update_status'])->name('admin.return.status.update');
});


//Routes User

Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard', [UserController::class,'index'])->name('user.index');
    Route::get('/account-orders', [UserController::class,'orders'])->name('user.orders');
    Route::get('/account-orders/{order_number}', [UserController::class,'order_details'])->name('user.order.details');
    Route::get('/account-orders/{order_number}/invoice', [UserController::class,'order_invoice'])->name('user.order.invoice');
    Route::post('/account-orders/{order_number}/return', [UserController::class,'returnRequest'])->middleware('throttle:5,1')->name('user.order.return');

    Route::get('/account-address', [UserController::class,'address'])->name('user.address');
    Route::put('/account-address', [UserController::class,'updateAddress'])->name('user.address.update');
    Route::get('/account-details', [UserController::class,'details'])->name('user.details');
    Route::put('/account-details', [UserController::class,'updateDetails'])->name('user.details.update');
    Route::put('/account-details/password', [UserController::class,'updatePassword'])->name('user.password.update');

    //checkout routes
    Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class,'store'])->middleware('throttle:10,1')->name('checkout.store');
    Route::get('/order/confirmation/{order_number}', [CheckoutController::class,'confirmation'])->name('checkout.confirmation');
    Route::post('/checkout/coupon', [CheckoutController::class,'applyCoupon'])->name('checkout.coupon.apply');
    Route::delete('/checkout/coupon', [CheckoutController::class,'removeCoupon'])->name('checkout.coupon.remove');

    //gdpr routes
    Route::get('/account/export-data', [UserController::class,'exportData'])->name('user.export-data');
    Route::delete('/account/delete', [UserController::class,'deleteAccount'])->name('user.delete-account');

    //wishlist routes
    Route::get('/account-wishlist', [WishlistController::class,'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class,'toggle'])->name('wishlist.toggle');

    //review routes
    Route::post('/review/store', [ReviewController::class,'store'])->middleware('throttle:5,1')->name('review.store');
});

//Stripe webhook (Stripe sends no CSRF token; signature is verified in the controller instead)
Route::post('/stripe/webhook', [StripeWebhookController::class,'handle'])->name('stripe.webhook');

//locale switch
Route::get('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['en', 'fr'], true), 404);
    session(['locale' => $locale]);
    return redirect()->back();
})->name('locale.switch');

//content pages
Route::get('/about', [PageController::class,'about'])->name('pages.about');
Route::get('/faq', [PageController::class,'faq'])->name('pages.faq');
Route::get('/contact', [PageController::class,'contact'])->name('pages.contact');
Route::post('/contact', [PageController::class,'contactSubmit'])->middleware('throttle:5,1')->name('contact.submit');

//legal pages
Route::get('/mentions-legales', [LegalController::class,'mentionsLegales'])->name('legal.mentions');
Route::get('/cgv', [LegalController::class,'cgv'])->name('legal.cgv');
Route::get('/politique-de-confidentialite', [LegalController::class,'confidentialite'])->name('legal.confidentialite');
Route::get('/politique-de-cookies', [LegalController::class,'cookies'])->name('legal.cookies');