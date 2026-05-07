<?php
namespace App\Http\Controllers;

use App\Models\GuideCategory;
use App\Models\Service;

class GuideController extends Controller
{
    public function index()
    {
        // جلب الفئات الرئيسية (بدون أب) مع أبنائها (للشاشة الرئيسية)
        $categories = GuideCategory::with(['children' => function ($q) {
            $q->orderBy('order');
        }])
            ->whereNull('parent_id')
            ->active()
            ->orderBy('order')
            ->get();

        return view('guide.index', compact('categories'));
    }

    public function show($slug)
    {
        // عند فتح صفحة تصنيف معين (مثل Cosmetic Dentistry)
        // نعرض الخدمات التي تنتمي لهذا التصنيف وأبنائه إذا وجدت
        $category = GuideCategory::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // جلب الخدمات مباشرة لهذا التصنيف + تصنيفات الأبناء (اختياري)
        $services = Service::where('category_id', $category->id)
            ->orWhereIn('category_id', $category->children->pluck('id'))
            ->active()
            ->orderBy('order')
            ->get();

        return view('guide.category', compact('category', 'services'));
    }
}
