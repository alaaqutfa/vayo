<?php

use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GuideCategoryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontGalleryController;
use App\Http\Controllers\FrontTestimonialController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages dynamiques (About, Privacy, Terms, etc.)
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

// Static pages (explicit for SEO)
Route::get('/about', [PageController::class, 'show'])->name('about')->defaults('slug', 'about');
Route::get('/privacy', [PageController::class, 'show'])->name('privacy')->defaults('slug', 'privacy');
Route::get('/terms', [PageController::class, 'show'])->name('terms')->defaults('slug', 'terms');

// Sections
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/departments', [GuideController::class, 'index'])->name('departments');
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');
Route::get('/gallery', [FrontGalleryController::class, 'index'])->name('gallery');
Route::get('/testimonials', [FrontTestimonialController::class, 'index'])->name('testimonials');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

// 404 fallback
Route::fallback(fn() => response()->view('errors.404', [], 404))->name('404');

// Guide Menu
Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');
Route::get('/guide/{slug}', [GuideController::class, 'show'])->name('guide.category');

// Language switcher
Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// Auth scaffolding (Breeze)
require __DIR__ . '/auth.php';

// Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('services', AdminServiceController::class)->except(['show']);
    Route::patch('services/{service}/toggle-status', [AdminServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::patch('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');
    Route::resource('galleries', GalleryController::class)->except(['show']);
    Route::patch('galleries/{gallery}/toggle-status', [GalleryController::class, 'toggleStatus'])->name('galleries.toggle-status');
    Route::resource('pages', AdminPageController::class)->except(['show']);
    Route::patch('pages/{page}/toggle-status', [AdminPageController::class, 'toggleStatus'])->name('pages.toggle-status');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('translations', [TranslationController::class, 'index'])->name('translations.index');
    Route::post('translations', [TranslationController::class, 'update'])->name('translations.update');
    Route::post('translations/key', [TranslationController::class, 'createKey'])->name('translations.key.store');
    Route::delete('translations/{id}', [TranslationController::class, 'destroy'])->name('translations.destroy');
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('media/reorder', [MediaController::class, 'reorder'])->name('media.reorder');
    Route::delete('media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
    Route::get('api/media', [MediaController::class, 'apiIndex'])->name('media.api');
    Route::resource('guide-categories', GuideCategoryController::class)->except(['show']);
    Route::patch('guide-categories/{guideCategory}/toggle-status', [GuideCategoryController::class, 'toggleStatus'])->name('guide-categories.toggle-status');
    Route::resource('faqs', AdminFaqController::class)->except(['show']);
    Route::patch('faqs/{faq}/toggle-status', [AdminFaqController::class, 'toggleStatus'])->name('faqs.toggle-status');

    Route::resource('doctors', AdminDoctorController::class)->except(['show']);
    Route::patch('doctors/{doctor}/toggle-status', [AdminDoctorController::class, 'toggleStatus'])->name('doctors.toggle-status');

    Route::resource('appointments', AdminAppointmentController::class)->only(['index', 'show', 'destroy']);
    Route::patch('appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.update-status');

    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::patch('contact-messages/{contactMessage}/mark-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
});
