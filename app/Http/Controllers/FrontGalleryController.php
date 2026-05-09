<?php
namespace App\Http\Controllers;

use App\Models\Gallery;

class FrontGalleryController extends Controller
{
    /**
     * عرض صفحة المعرض مع جميع الصور والفيديوهات النشطة
     */
    public function index()
    {
        $galleryItems = Gallery::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('gallery', compact('galleryItems'));
    }

    /**
     * عرض تفاصيل عنصر معين (اختياري)
     */
    public function show($id)
    {
        $item = Gallery::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return view('gallery-show', compact('item'));
    }
}
