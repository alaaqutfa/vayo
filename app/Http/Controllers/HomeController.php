<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services     = Service::where('is_active', true)->orderBy('order')->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->take(6)->get();
        $galleryItems = Gallery::where('is_active', true)->orderBy('order')->take(8)->get();
        $doctors      = Doctor::active()->ordered()->take(6)->get();

        return view('home.index', compact('services', 'testimonials', 'galleryItems','doctors'));
    }
}
