<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorRequest;
use App\Models\Doctor;
use App\Models\Service;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $doctors = Doctor::orderBy('order')->paginate(15);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $services = Service::active()->orderBy('name')->get();
        return view('admin.doctors.create', compact('services'));
    }

    public function store(DoctorRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'doctors', 300, 300);
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function edit(Doctor $doctor)
    {
        $services = Service::active()->orderBy('name')->get();
        return view('admin.doctors.edit', compact('doctor', 'services'));
    }

    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($doctor->image) {
                $this->deleteImage($doctor->image);
            }
            $data['image'] = $this->uploadImage($request->file('image'), 'doctors', 300, 300);
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->image) {
            $this->deleteImage($doctor->image);
        }
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted.');
    }

    public function toggleStatus(Doctor $doctor)
    {
        $doctor->is_active = !$doctor->is_active;
        $doctor->save();

        return back()->with('success', 'Status updated.');
    }
}
