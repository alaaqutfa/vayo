<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // مشاركة الإعدادات العامة مع جميع القوالب
        View::composer('*', function ($view) {
            $settings = Setting::all()->pluck('value', 'key')->toArray();
            $view->with('settings', $settings);
        });

        // مشاركة الخدمات النشطة المرتبة مع الأقسام التي تحتاجها
        View::composer(['sections.featured-departments', 'sections.featured-services'], function ($view) {
            $services = Service::where('is_active', true)->orderBy('order')->get();
            $view->with('services', $services);
        });

        // مشاركة التجارب النشطة
        View::composer('sections.testimonials', function ($view) {
            $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
            $view->with('testimonials', $testimonials);
        });

        // مشاركة عناصر المعرض النشطة
        View::composer('sections.gallery', function ($view) {
            $galleryItems = Gallery::where('is_active', true)->orderBy('order')->get();
            $view->with('galleryItems', $galleryItems);
        });
    }

    public function register(): void {}
}
