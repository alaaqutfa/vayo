<?php
namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of all active services.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

        return view('services.index', compact('services'));
    }

    /**
     * Display a single active service by slug.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('services.show', compact('service'));
    }
}
