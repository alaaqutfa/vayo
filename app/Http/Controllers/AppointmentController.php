<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * عرض نموذج حجز الموعد
     */
    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('name')->get();
        $doctors  = Doctor::where('is_active', true)->orderBy('name')->get();
        return view('appointment', compact('services', 'doctors'));
    }

    /**
     * تخزين بيانات الموعد في قاعدة البيانات وإرسال إشعار
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:20',
            'department' => 'nullable|exists:services,id',
            'doctor_id'  => 'nullable|exists:doctors,id',
            'date'       => 'required|date|after_or_equal:today',
            'message'    => 'nullable|string',
        ]);

        Appointment::create($validated);

        return redirect()->route('appointment')->with('success', __('appointment_success_message'));
    }
}
