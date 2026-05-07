<?php
namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * عرض صفحة الأسئلة الشائعة
     */
    public function index()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('faq', compact('faqs'));
    }
}
