<?php

use App\Livewire\Pages\AboutPage;
use App\Livewire\Pages\BlogPage;
use App\Livewire\Pages\BlogSinglePage;
use App\Livewire\Pages\ContactPage;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\ProductCategorieArchive;
use App\Livewire\Pages\ProductSinglePage;
use App\Livewire\Pages\ShopPage;
use App\Livewire\Pages\ShopPageSingle;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', HomePage::class)->name('page.home');
Route::get('/shop', ShopPage::class)->name('page.shop');
Route::get('/shop/{prod_slug}', ProductSinglePage::class)->name('page.shop.single');
Route::get('/shop/categories/{prod_cat_slug}', ProductCategorieArchive::class)->name('page.shop.category');
Route::get('/blog', BlogPage::class)->name('page.blog');
Route::get('/blog/{slug}', BlogSinglePage::class)->name('page.blog.single');

Route::get('/about', AboutPage::class)->name('page.about');
Route::get('/contact', ContactPage::class)->name('page.contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
