<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactEventController;
use App\Http\Controllers\ContactGroupController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\UserWishPhotoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ContactInterestController;
use App\Http\Controllers\WishPhotoTemplateController;

//use App\Http\Controllers\ActivityController;
//use App\Http\Controllers\WishController;


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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::get('/password/reset', [ForgotPasswordController::class, 'index'])->name('password.request');

Route::get('/test-email', [ForgotPasswordController::class, 'sendTestEmail']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
Route::get('/password/sent', function () {return view('auth.passwordSent');})->name('password.sent');

/*
Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');
Route::get('/gifts/view/{id}', [GiftController::class, 'view'])->name('gifts.view');
*/

// Products
Route::get('/gifts', [ProductController::class, 'index'])->name('gifts.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/variant/quantity', [ProductController::class, 'getVariantQuantity']);
Route::post('/products/variant/sizes', [ProductController::class, 'getAvailableSizes']);
Route::post('/products/variant/sizes', [ProductController::class, 'getSizes'])->name('product.getSizes');
Route::get('/products/filter', [ProductController::class, 'filterByCategory']);
Route::post('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/category/{id}', [ProductController::class, 'showCategory'])->name('category');
Route::post('/products/filter', [ProductController::class, 'filter'])->name('products.filter');


Route::get('/products/category/{id}', [ProductController::class, 'showCategory'])->name('products.category');
Route::get('/products/brand/{id}', [ProductController::class, 'showBrand'])->name('products.brand');

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
Route::get('/blog/{id}/{title}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
})->name('switchLang');

Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');


Route::middleware('auth')->prefix('user')->group(function () {

    Route::get('dashboard', [UserController::class, 'index'])->name('user.index');

    // User Panel
    Route::get('contacts', [ContactController::class, 'index'])->name('user.contacts.index');
    Route::get('contacts/{id}', [ContactController::class, 'show'])->where('id', '[0-9]+')->name('contacts.show');

    // Contacts
    Route::get('contacts/create', [ContactController::class, 'create'])->name('user.contacts.create');
    Route::post('contacts', [ContactController::class, 'store'])->name('user.contacts.store');

    Route::get('contacts/edit/{contact}', [ContactController::class, 'edit'])->name('user.contacts.edit');
    Route::put('contacts/update/{contact}', [ContactController::class, 'update'])->name('user.contacts.update');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('user.contacts.show');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('user.contacts.destroy');


    Route::get('groups', [GroupController::class, 'index'])->name('user.groups.index');
    Route::get('groups/create', [GroupController::class, 'create'])->name('user.groups.create');
    Route::post('groups', [GroupController::class, 'store'])->name('user.groups.store');
    Route::get('groups/{group}', [GroupController::class, 'show'])->name('user.groups.show');
    Route::get('groups/{group}/edit', [GroupController::class, 'edit'])->name('user.groups.edit');
    Route::put('groups/{group}', [GroupController::class, 'update'])->name('user.groups.update');
    Route::delete('groups/{group}', [GroupController::class, 'destroy'])->name('user.groups.destroy');

    Route::post('/groups/bulk-delete', [GroupController::class, 'bulkDelete'])->name('user.groups.bulk-delete');
    Route::post('/groups/bulk-status-update', [GroupController::class, 'bulkStatusUpdate'])->name('user.groups.bulk-status-update');


    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversation}/message', [ChatController::class, 'storeMessage'])->name('chat.storeMessage');
    Route::delete('/chat/message/{message}', [ChatController::class, 'deleteMessage'])->name('chat.deleteMessage');
    Route::delete('/chat/{conversation}', [ChatController::class, 'deleteConversation'])->name('chat.deleteConversation');
    Route::post('/chat/create', [ChatController::class, 'create'])->name('chat.create');
    // New route for creating/finding conversation by user ID
    Route::get('/chat/user/{id}', [ChatController::class, 'chatWithUser'])->name('chat.withUser');

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');

    Route::get('/settings', [ProfileController::class, 'index'])->name('user.settings');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('user.calendar.index');

    Route::prefix('contacts/{contact}')->group(function () {
        Route::get('interests', [ContactInterestController::class, 'index'])->name('contacts.interests.index');
        Route::post('interests', [ContactInterestController::class, 'store'])->name('contacts.interests.store');
        Route::delete('interests/{interest}/{type}', [ContactInterestController::class, 'destroy'])->name('contacts.interests.destroy');
        Route::post('sms', [ContactController::class, 'sendSms'])->name('contacts.sendSms');
        Route::post('email', [ContactController::class, 'sendEmail'])->name('contacts.sendEmail');


    });
    Route::post('contacts/bulk-delete', [ContactController::class, 'bulkDelete'])->name('user.contacts.bulk-delete');
    Route::post('contacts/bulk-status-update', [ContactController::class, 'bulkStatusUpdate'])->name('user.contacts.bulk-status-update');

    //User Events part
    Route::get('events', [UserEventController::class, 'index'])->name('user.events.index');
    Route::get('events/create', [UserEventController::class, 'create'])->name('user.events.create');
    Route::post('events', [UserEventController::class, 'store'])->name('user.events.store');
    Route::get('/events/edit/{event}', [UserEventController::class, 'edit'])->name('user.events.edit');
    Route::put('events/{event}', [UserEventController::class, 'update'])->name('user.events.update');
    Route::get('events/{event}', [UserEventController::class, 'show'])->name('user.events.show');
    Route::delete('events/{event}', [UserEventController::class, 'destroy'])->name('user.events.delete');


    // User wish photos
    Route::resource('wish-photos', UserWishPhotoController::class);
    Route::get('wish-photos', [UserWishPhotoController::class, 'index'])->name('user.wish-photos.index');
    Route::get('wish-photos/create/{templateId?}', [UserWishPhotoController::class, 'create'])->name('user.wish-photos.create');
    Route::get('wish-photos/{id}', [UserWishPhotoController::class, 'show'])->name('user.wish-photos.show');
    Route::get('wish-photos/{id}/download', [UserWishPhotoController::class, 'download'])->name('user.wish-photos.download');
    Route::post('wish-photos', [UserWishPhotoController::class, 'store'])->name('user.wish-photos.store');

});

//Adding events from Contacts
Route::prefix('contacts/{contact}/events')->name('contacts.events.')->group(function () {
    Route::get('/', [ContactEventController::class, 'index'])->name('index');
    Route::get('/create', [ContactEventController::class, 'create'])->name('create');
    Route::post('/', [ContactEventController::class, 'store'])->name('store');
    Route::get('/{event}/edit', [ContactEventController::class, 'edit'])->name('edit');
    Route::put('/{event}', [ContactEventController::class, 'update'])->name('update');
    Route::get('/{event}', [ContactEventController::class, 'show'])->name('show');
    Route::delete('/{event}', [ContactEventController::class, 'destroy'])->name('destroy');
});

// Adding groups from Contacts
Route::prefix('contacts/{contact}/groups')->name('contacts.groups.')->group(function () {
    Route::get('/', [ContactGroupController::class, 'index'])->name('index');
    Route::get('/create', [ContactGroupController::class, 'create'])->name('create');
    Route::post('/', [ContactGroupController::class, 'store'])->name('store');
    Route::get('/{group}/edit', [ContactGroupController::class, 'edit'])->name('edit');
    Route::put('/{group}', [ContactGroupController::class, 'update'])->name('update');
    Route::get('/{group}', [ContactGroupController::class, 'show'])->name('show');
    Route::delete('/{group}', [ContactGroupController::class, 'destroy'])->name('destroy');
});

//Activity Part


Route::get('/events/{categoryId}', [ContactController::class, 'getEventsByCategory']);
Route::get('/contacts/events', [ContactController::class, 'getEventsByCategory'])->name('contacts.events');
Route::get('/events/category', [ContactController::class, 'getEventsByCategory']);
Route::get('/events/category/{categoryId}', [ContactController::class, 'getEventsByCategory']);
Route::post('/load-wish-message', [ContactController::class, 'loadWishMessage'])->name('loadWishMessage');
Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.withUser');
Route::post('/send-message/{contactId}', [ContactController::class, 'sendMessage'])->name('send.message');
Route::get('/messages/{event}', [ContactController::class, 'getMessages'])->name('get-messages');

Route::get('/get-messages', [ContactController::class, 'getMessages']);

// wishes
Route::get('/wishes', [WishController::class, 'index'])->name('wishes.index');
Route::get('/events-by-category', [WishController::class, 'getEventsByCategory'])->name('events.byCategory');



// Contact import
Route::post('/contacts/import/ios', [ContactController::class, 'importFromIos'])->name('contacts.import.ios');
Route::post('/contacts/import/android', [ContactController::class, 'importFromAndroid'])->name('contacts.import.android');

// Reviews
Route::middleware(['auth'])->group(function () {
    Route::get('products/{product}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('products/{product}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Wish photo editor
Route::get('wish-photos', [WishPhotoTemplateController::class, 'index'])->name('wish-photos');


Route::get('api/wish-photo-templates', [WishPhotoTemplateController::class, 'apiIndex']);

// Cart part
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/products/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{itemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/payment', [CheckoutController::class, 'processPayment'])->name('payment.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
