<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FavoriteController;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\CarouselController;


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

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');


Route::resource('products', ProductController::class);
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/user/product/{user}', [ProductController::class, 'userProducts'])->name('products.user_products');
Route::get('/product/edit/{product}', [ProductController::class, 'getProductCategories'])->name('product.get_edit');
Route::get('/get-products-by-category-and-location', [ProductController::class, 'getProductsByCategoryAndLocation']);


Route::get('/product/{product}/comments', [CommentController::class, 'index']);
Route::post('/product/{product}/comment', [CommentController::class, 'store']);

Route::get('/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/{profile}/get', [ProfileController::class, 'getProfile'])->name('profile.get_edit');
Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');





Route::post('/profile/picture/{profile}/update', [ProfileController::class, 'setProfilePicture']);

// web.php
Route::get('/profile/{profile}/chat', [ChatController::class, 'index'])->name('profile.chat');
Route::get('/profile/{profile}/chat/friends', [ChatController::class, 'getFriends']);
Route::get('/profile/{profile}/chat/friends/{receiver}', [ChatController::class, 'getPrivateMessages']);
Route::post('/profile/{profile}/chat/friends/{receiver}', [ChatController::class, 'setPrivateMessages']);
Route::get('/chat/{receiver_id}', [ChatController::class, 'startChat'])->name('chat.start');




Route::post('/products/{product}/favorite', [FavoriteController::class, 'store'])->name('products.favorite');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.remove');
Route::get('/user/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/products/{product}/favorite', [FavoriteController::class, 'toggleFavorite'])->name('products.favorite');
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.remove');

Route::get('/profile/{profileId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/profile/{profileId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/my-reviews', [ProfileController::class, 'myReviews'])->name('profile.reviews'); //review dari orang lain
Route::get('/profile/{profileId}', [ReviewController::class, 'show'])->name('profile.show');


// Rute untuk laporan produk
Route::get('/products/{id}/report', [ProductController::class, 'report'])->name('products.report')->middleware('auth');
Route::post('/products/{id}/report', [ProductController::class, 'storeReport'])->name('products.storeReport')->middleware('auth');
Route::get('/admin/laporan-masuk', [AdminController::class, 'showLaporanMasuk'])->name('admin.laporanmasuk');

Route::get('/admin/ditolak', [AdminController::class, 'index'])->name('admin.ditolak'); // Menggunakan metode index sebagai gantinya
Route::get('/admin/ditindak', [AdminController::class, 'index'])->name('admin.ditindak');
Route::post('/admin/tolak/{id}', [AdminController::class, 'tolak'])->name('admin.tolak');
Route::post('/admin/blokir-pengguna/{reportId}', [AdminController::class, 'blockUser'])->name('admin.blokirPengguna');
// routes/web.php
Route::get('/admin/ditolak', [AdminController::class, 'rejected'])->name('admin.ditolak');
// routes/web.php
Route::get('/admin/ditindak', [AdminController::class, 'actionTaken'])->name('admin.ditindak');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/kategori', [AdminController::class, 'showCategories'])->name('admin.kategori');
    Route::post('admin/addCategory', [AdminController::class, 'addCategory'])->name('admin.addCategory');
    Route::put('admin/editCategory/{id}', [AdminController::class, 'editCategory'])->name('admin.editCategory');
    Route::delete('admin/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');
});


Route::get('/about-second-swap', [PageController::class, 'showAboutSecondSwap']);
Route::get('/hubungi-kami', [PageController::class, 'showHubungiKami']);
Route::get('/tentang-kami', [PageController::class, 'showTentangKami']);







// Rute admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/block-user/{userId}', [AdminController::class, 'blockUser'])->name('admin.blockUser');
});

Route::get('/get-regencies', [ProductController::class, 'getRegencies']);
Route::get('/get-districts', [ProductController::class, 'getDistricts']);

Route::get('/get-by-district', [ProductController::class, 'getByDistrict']);

Route::get('/get-products-by-district/{districtId}', [ProductController::class, 'getProductsByDistrict']);

Route::get('/get-products-by-category-and-location', [ProductController::class, 'getProductsByCategoryAndLocation']);
Route::get('/get-products-by-category-and-location', [ProductController::class, 'getProductsByCategoryAndLocation']);


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('carousel', [CarouselController::class, 'index'])->name('admin.carousel.index');
    Route::post('carousel', [CarouselController::class, 'store'])->name('admin.carousel.store');
    Route::delete('carousel/{id}', [CarouselController::class, 'destroy'])->name('admin.carousel.destroy');
});




Route::post('/profile/{user_id}/chat/friends/{receiver_id}/read', [ChatController::class, 'markMessagesAsRead']);

Route::post('/messages/read', [ChatController::class, 'markMessagesAsRead'])->name('messages.read');

// routes/web.php
Route::get('/profile/{id}/chat/friends', [ChatController::class, 'getFriends']);
Route::get('/profile/{id}/chat/friends/{friend_id}', [ChatController::class, 'getPrivateMessages']);
Route::post('/profile/{id}/chat/friends/{friend_id}/read', [ChatController::class, 'markMessagesAsRead']);
Route::post('/profile/{id}/chat/friends/{friend_id}', [ChatController::class, 'setPrivateMessages']);














