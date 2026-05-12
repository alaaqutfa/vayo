<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $services     = Schema::hasTable('services') ? Service::where('is_active', true)->orderBy('order')->take(6)->get() : collect();
        $testimonials = Schema::hasTable('testimonials') ? Testimonial::where('is_active', true)->orderBy('order')->get() : collect();
        $galleryItems = Schema::hasTable('galleries') ? Gallery::where('is_active', true)->orderBy('order')->take(15)->get() : collect();
        $doctors      = Schema::hasTable('doctors') ? Doctor::active()->ordered()->take(6)->get() : collect();

        return view('home.index', compact('services', 'testimonials', 'galleryItems','doctors'));
    }
}
