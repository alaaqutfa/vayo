<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::active()->ordered();

        if ($request->filled('specialty') && $request->specialty != 'all') {
            $query->where('specialty', $request->specialty);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('service_id')) {
            $query->whereHas('services', function ($q) use ($request) {
                $q->where('services.id', $request->service_id);
            });
        }

        $doctors = $query->paginate(12);

        // Get unique specialties for filter
        $specialties = Doctor::active()->select('specialty')->distinct()->pluck('specialty');

        return view('doctors.index', compact('doctors', 'specialties'));
    }

    public function show($id)
    {
        $doctor = Doctor::active()->with('services')->findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }
}
