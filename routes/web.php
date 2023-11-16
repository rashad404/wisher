<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;
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

Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');
Route::get('/gifts/view/{id}', [GiftController::class, 'view'])->name('gifts.view');

// User Panel
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.index');
Route::get('/user/contacts', [ContactController::class, 'index'])->name('user.contacts');
Route::get('/user/contacts/{id}', [ContactController::class, 'show'])->where('id', '[0-9]+')->name('contacts.show');

// Contacts
Route::get('/user/contacts/create', [ContactController::class, 'create'])->name('user.contacts.create');
Route::post('/user/contacts', [ContactController::class, 'store'])->name('user.contacts.store');

Route::get('/user/contacts/edit/{contact}', [ContactController::class, 'edit'])->name('user.contacts.edit');
Route::put('/user/contacts/update/{contact}', [ContactController::class, 'update'])->name('user.contacts.update');

Route::get('/user/contacts/delete/{contact}', [ContactController::class, 'destroy'])->name('user.contacts.delete');

