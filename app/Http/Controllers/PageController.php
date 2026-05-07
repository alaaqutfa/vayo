<?php
namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a single page by its slug.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // جلب الصفحة النشطة فقط
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // إرجاع العرض مع بيانات الصفحة
        return view('page', compact('page'));
    }
}
