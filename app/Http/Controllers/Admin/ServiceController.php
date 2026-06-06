<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\GuideCategory;
use App\Models\Service;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ServiceController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = GuideCategory::active()->orderBy('order')->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadServiceImage($request->file('image'));
        }

        $data['features'] = $data['features'] ?? [];
        $data['slug']     = $this->generateUniqueSlug($data['name']);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = GuideCategory::active()->orderBy('order')->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $data = $request->validated();

        // Handle image deletion
        if ($request->input('delete_image')) {
            if ($service->image) {
                $this->deleteImage($service->image);
            }
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            // Upload new image
            if ($service->image) {
                $this->deleteImage($service->image);
            }
            $data['image'] = $this->uploadServiceImage($request->file('image'));
        }

        $data['features'] = $data['features'] ?? [];
        $data['slug']     = $this->generateUniqueSlug($data['name'], $service->id);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->deleteImage($service->image);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function toggleStatus(Service $service)
    {
        $service->is_active = ! $service->is_active;
        $service->save();

        return redirect()->back()->with('success', 'Status updated.');
    }

    protected function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);

        if ($baseSlug === '') {
            throw ValidationException::withMessages([
                'name' => 'Service name must contain letters or numbers to generate a valid link.',
            ]);
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            Service::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
