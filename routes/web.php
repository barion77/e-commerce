<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddHomeSlideComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('product.shop');
Route::get('/cart', CartComponent::class)->name('product.cart');
Route::get('/checkout', CheckoutComponent::class)->name('product.checkout');
Route::get('/product/{slug}', DetailComponent::class)->name('product.detail');
Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// for user
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

// for admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'verified', 'auth.admin']], function() {
    Route::get('dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('category/add', AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.category.edit');

    Route::get('products', AdminProductComponent::class)->name('admin.products');
    Route::get('pruduct/add', AdminAddProductComponent::class)->name('admin.product.add');
    Route::get('product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.product.edit');

    Route::get('slider', AdminHomeSliderComponent::class)->name('admin.slider');
    Route::get('slider/add', AdminAddHomeSlideComponent::class)->name('admin.slider.add');
    Route::get('slider/edit/{slider_id}', AdminEditHomeSliderComponent::class)->name('admin.slider.edit');

    Route::get('home-categories', AdminHomeCategoryComponent::class)->name('admin.home-categories');

    Route::get('sale', AdminSaleComponent::class)->name('admin.sale');
});
