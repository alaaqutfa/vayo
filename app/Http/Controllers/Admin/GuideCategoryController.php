<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuideCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuideCategoryController extends Controller
{
    public function index()
    {
        $categories = GuideCategory::with('parent')->orderBy('order')->paginate(15);
        return view('admin.guide-categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = GuideCategory::roots()->orderBy('order')->get();
        return view('admin.guide-categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|unique:guide_categories,slug',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string',
            'parent_id'   => 'nullable|exists:guide_categories,id',
            'order'       => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        GuideCategory::create($data);

        return redirect()->route('admin.guide-categories.index')->with('success', 'Category created.');
    }

    public function edit(GuideCategory $guideCategory)
    {
        $parents = GuideCategory::where('id', '!=', $guideCategory->id)->roots()->orderBy('order')->get();
        return view('admin.guide-categories.edit', compact('guideCategory', 'parents'));
    }

    public function update(Request $request, GuideCategory $guideCategory)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|unique:guide_categories,slug,' . $guideCategory->id,
            'description' => 'nullable|string',
            'icon'        => 'nullable|string',
            'parent_id'   => 'nullable|exists:guide_categories,id',
            'order'       => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $guideCategory->update($data);

        return redirect()->route('admin.guide-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(GuideCategory $guideCategory)
    {
        $guideCategory->delete();
        return redirect()->route('admin.guide-categories.index')->with('success', 'Category deleted.');
    }

    public function toggleStatus(GuideCategory $guideCategory)
    {
        $guideCategory->is_active = ! $guideCategory->is_active;
        $guideCategory->save();
        return redirect()->back()->with('success', 'Status updated.');
    }
}
