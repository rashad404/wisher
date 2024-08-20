<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;
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

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/about', [MainController::class, 'about'])->name('main.about');
Route::get('/how-it-works', [MainController::class, 'howItWorks'])->name('main.howItWorks');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::get('/password/reset', [ForgotPasswordController::class, 'index'])->name('password.request');

Route::get('/test-email', [ForgotPasswordController::class, 'sendTestEmail']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
Route::get('/password/sent', function () {return view('auth.passwordSent');})->name('password.sent');

Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');
Route::get('/gifts/view/{id}', [GiftController::class, 'view'])->name('gifts.view');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/variant/quantity', [ProductController::class, 'getVariantQuantity']);
Route::post('/products/variant/sizes', [ProductController::class, 'getAvailableSizes']);

// User Panel
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.index');
Route::get('/user/contacts', [ContactController::class, 'index'])->name('user.contacts.index');
Route::get('/user/contacts/{id}', [ContactController::class, 'show'])->where('id', '[0-9]+')->name('contacts.show');

// Contacts
Route::get('/user/contacts/create', [ContactController::class, 'create'])->name('user.contacts.create');
Route::post('/user/contacts', [ContactController::class, 'store'])->name('user.contacts.store');

Route::get('/user/contacts/edit/{contact}', [ContactController::class, 'edit'])->name('user.contacts.edit');
Route::put('/user/contacts/update/{contact}', [ContactController::class, 'update'])->name('user.contacts.update');
Route::get('/user/contacts/{contact}', [ContactController::class, 'show'])->name('user.contacts.show');
Route::delete('/user/contacts/{contact}', [ContactController::class, 'destroy'])->name('user.contacts.destroy');


Route::get('/user/groups', [GroupController::class, 'index'])->name('user.groups.index');
Route::get('/user/groups/create', [GroupController::class, 'create'])->name('user.groups.create');
Route::post('/user/groups', [GroupController::class, 'store'])->name('user.groups.store');
Route::get('/user/groups/{group}', [GroupController::class, 'show'])->name('user.groups.show');
Route::get('/user/groups/{group}/edit', [GroupController::class, 'edit'])->name('user.groups.edit');
Route::put('/user/groups/{group}', [GroupController::class, 'update'])->name('user.groups.update');
Route::delete('/user/groups/{group}', [GroupController::class, 'destroy'])->name('user.groups.destroy');


Route::post('groups/{group}/add-contact', [GroupController::class, 'addContact'])->name('user.groups.addContact');
Route::delete('groups/{group}/remove-contact/{contact}', [GroupController::class, 'removeContact'])->name('user.groups.removeContact');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
Route::get('/unsubscribe/{email}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms', [PageController::class, 'termsOfService'])->name('terms-of-service');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

Route::get('/contact', [PageController::class, 'showContactForm'])->name('contact.show');
Route::post('/contact', [PageController::class, 'submitContactForm'])->name('contact.submit');

Route::get('/features', [PageController::class, 'features'])->name('features');

Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
})->name('switchLang');
