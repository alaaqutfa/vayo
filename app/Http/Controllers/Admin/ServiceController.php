<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\GuideCategory;
use App\Models\Service;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Str;

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
        $data['slug']     = Str::slug($data['name']);

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

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadServiceImage($request->file('image'), $service->image);
        }

        $data['features'] = $data['features'] ?? [];
        $data['slug']     = Str::slug($data['name']);

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
}
