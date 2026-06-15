<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = Schema::hasTable('settings')
                ? Setting::all()->pluck('value', 'key')->toArray()
                : [];
            $view->with('settings', $settings);
        });

        View::composer(['home.sections.featured-departments', 'home.sections.featured-services'], function ($view) {
            $services = Schema::hasTable('services')
                ? Service::active()->ordered()->get()
                : collect();

            $dentistryServices = Schema::hasTable('services')
                ? Service::active()->ordered()->where(function ($query) {
                    $query->where('slug', 'like', '%dental%')
                        ->orWhere('slug', 'like', '%implant%')
                        ->orWhere('slug', 'like', '%veneer%')
                        ->orWhere('slug', 'like', '%whitening%')
                        ->orWhere('slug', 'like', '%gum%')
                        ->orWhere('slug', 'like', '%invisalign%')
                        ->orWhere('name', 'like', '%Dental%')
                        ->orWhere('name', 'like', '%implant%')
                        ->orWhere('name', 'like', '%Veneer%')
                        ->orWhere('name', 'like', '%Whitening%')
                        ->orWhere('name', 'like', '%Gum%')
                        ->orWhere('name', 'like', '%Invisalign%');
                })->get()
                : collect();

            $view->with('services', $services);
            $view->with('dentistryServices', $dentistryServices);
        });

        View::composer('sections.testimonials', function ($view) {
            $testimonials = Schema::hasTable('testimonials')
                ? Testimonial::where('is_active', true)->orderBy('order')->get()
                : collect();
            $view->with('testimonials', $testimonials);
        });

        View::composer('sections.gallery', function ($view) {
            $galleryItems = Schema::hasTable('galleries')
                ? Gallery::where('is_active', true)->orderBy('order')->get()
                : collect();
            $view->with('galleryItems', $galleryItems);
        });
    }

    public function register(): void {}
}
