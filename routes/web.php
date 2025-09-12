<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HeroBannerController;

//___________________________________// START \\______________________________________________//
Route::get('/', [HomeController::class, 'welcome'])->name('/');

/**______________________________________________________________________________________________
 * View Page => ALL
 * ______________________________________________________________________________________________
 */
Route::get('comming/soon', [HomeController::class, 'comming_soon'])->name('comming_soon');
//______________ ABOUT US
Route::get('page/about-us', [HomeController::class, 'about'])->name('page.about-us');
//______________ PROPERTIES
Route::get('page/properties', [HomeController::class, 'properties'])->name('page.properties');
Route::get('page/properties-details/{slug}', [HomeController::class, 'propertyDetails'])->name('page.property-details');
//______________ CONTACT
Route::get('page/contact', [HomeController::class, 'contact'])->name('page.contact');
Route::post('page/contact', [HomeController::class, 'contactStore'])->name('page.contact.store');
//______________ APPLICATION
Route::get('page/application-from', [HomeController::class, 'applicationFrom'])->name('page.application-from');
Route::post('page/application-submit', [HomeController::class, 'applicationSubmit'])->name('page.application.submit');
Route::get('page/application-success', [HomeController::class, 'applicationSuccess'])->name('page.application.success');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard
Route::get('/{path?}', [AdminController::class, 'index'])->where('path', 'dashboard|admin')->middleware(['auth', 'verified'])->name('dashboard');


// Admin profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Features
    Route::get('/features', [FeatureController::class, 'index'])->name('features.index');
    Route::post('/features', [FeatureController::class, 'store'])->name('features.store');
    Route::post('/features/update', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('/features/{feature}', [FeatureController::class, 'destroy'])->name('features.destroy');

    // Properties
    Route::resource('properties', PropertyController::class);
    Route::delete('properties/image/{image}', [PropertyController::class, 'deleteImage'])->name('properties.image.delete');
    Route::delete('properties/attachment/{attachment}', [PropertyController::class, 'deleteAttachment'])->name('properties.attachment.delete');

    // Application
    Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/application-image-download/{id}/{type}', [ApplicationController::class, 'downloadImage'])->name('application.image.download');
    Route::post('/application-bulk-export', [ApplicationController::class, 'bulkExport'])->name('application.bulk.export');
    Route::delete('/application-delete/{id}', [ApplicationController::class, 'delete'])->name('application.delete');
    Route::post('/application-bulk-delete', [ApplicationController::class, 'bulkDelete'])->name('application.bulk.delete');
    Route::get('/application-image-zip-download/{id}', [ApplicationController::class, 'zipImageDownload'])->name('zip.image.download');

    // Application Success Message
    Route::get('/application-success', [ApplicationController::class, 'indexApplicationSuccesss'])->name('application-success.index');
    Route::put('/application-success/{id}', [ApplicationController::class, 'updateApplicationSuccess'])->name('application-success.update');

    // Hero Banner
    Route::get('/hero-banner', [HeroBannerController::class, 'index'])->name('hero-banner.index');
    Route::post('/hero-banner', [HeroBannerController::class, 'store'])->name('hero-banner.store');


    // Achievement
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::post('/achievements', [AchievementController::class, 'store'])->name('achievements.store');
    Route::post('/achievements/update', [AchievementController::class, 'update'])->name('achievements.update');
    Route::delete('/achievements/{id}', [AchievementController::class, 'destroy'])->name('achievements.destroy');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::post('/services/update', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Testimonials
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::post('/testimonials/update', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Story
    Route::get('/story', [StoryController::class, 'index'])->name('story.index');
    Route::put('/story/{id}', [StoryController::class, 'update'])->name('story.update');

    // Team
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::post('/team/update', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{team}', [TeamController::class, 'destroy'])->name('team.destroy');

    // Mission
    Route::get('/mission', [MissionController::class, 'index'])->name('mission.index');
    Route::put('/mission/{id}', [MissionController::class, 'update'])->name('mission.update');

    // contact
    Route::get('/contact', [ContactController::class, 'indexContact'])->name('contact.index');
    Route::put('/contact/{id}', [ContactController::class, 'updateContact'])->name('contact.update');

    Route::get('/submissions', [ContactController::class, 'indexSubmission'])->name('contact.submissions.index');
    Route::get('/submissions-show/{id}', [ContactController::class, 'showSubmission'])->name('contact.submissions.show');
    Route::delete('/submissions-destroy/{id}', [ContactController::class, 'destroySubmission'])->name('contact.submissions.destroy');

    // Payment Method
    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment-methods.index');
    Route::post('/payment-methods', [PaymentMethodController::class, 'store'])->name('payment-methods.store');
    Route::post('/payment-methods/update', [PaymentMethodController::class, 'update'])->name('payment-methods.update');
    Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/settings-update', [SettingController::class, 'update'])->name('setting.update');
});

require __DIR__.'/auth.php';
