<?php
namespace App\Http\Controllers;

use App\Models\Testimonial;

class FrontTestimonialController extends Controller
{
    /**
     * عرض صفحة جميع الشهادات مع التقييمات
     */
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

        return view('testimonials', compact('testimonials'));
    }

    /**
     * عرض شهادة واحدة بالتفصيل (اختياري)
     */
    public function show($id)
    {
        $testimonial = Testimonial::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return view('testimonials-show', compact('testimonial'));
    }
}
