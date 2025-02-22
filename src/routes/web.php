<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailableController;
use App\Http\Controllers\WebhookController;
use Stripe\Webhook;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ItemController::class, 'index'])->name('item.index');
Route::get('/search', [ItemController::class, 'search']);
Route::get('/item/comment/{item_id?}', [ItemController::class, 'comment']);
Route::get('/item/{item_id?}', [ItemController::class, 'detail']);
Route::post('/webhook', [WebhookController::class, 'webhook']);


Route::middleware('auth')->group(function () {
    Route::get('/mylist', [ItemController::class, 'mylist'])->name('item.mylist');
    Route::get('/purchase/address/{item_id?}', [UserController::class, 'address']);
    Route::post('/purchase/address', [UserController::class, 'update']);
    Route::get('/purchase/{item_id?}', [ItemController::class, 'purchase'])->name('item.purchase');
    Route::post('/favorite', [ItemController::class, 'favorite']);
    Route::get('/mypage', [ItemController::class, 'mypage']);
    Route::get('/mypage/profile', [UserController::class, 'profile']);
    Route::post('/mypage/profile', [UserController::class, 'store']);
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::post('/sell', [ItemController::class, 'store']);
    Route::post('/comment', [ItemController::class, 'post']);
    Route::post('/comment/delete', [ItemController::class, 'delete']);
    Route::get('/success', [StripeController::class, 'success'])->name('success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');
    Route::get('/checkout-payment', [StripeController::class, 'checkout'])->name('checkout.session');
    Route::get('/instruction', [StripeController::class, 'instruction']);
});

Route::prefix('admin')->group(function () {
    Route::middleware('auth:administrators')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::post('/logout', [AdminController::class, 'logout']);
        Route::get('/data', [AdminController::class, 'data']);
        Route::post('/user/delete', [AdminController::class, 'userDelete']);
        Route::post('/comment/delete', [AdminController::class, 'commentDelete']);
        Route::get('/mail', [MailableController::class, 'informationMail']);
        Route::post('/mail/send', [MailableController::class, 'informationSend']);
        Route::get('/user/mail', [MailableController::class, 'contactMail']);
        Route::post('/user/mail/send', [MailableController::class, 'contactSend']);
    });
    Route::get('/login', [AdminController::class, 'loginView'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
});
