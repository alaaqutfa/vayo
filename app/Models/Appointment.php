<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'department', 'doctor_id', 'date', 'doctor', 'message', 'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function departmentService()
    {
        return $this->belongsTo(Service::class, 'department');
    }

    // العلاقة مع الطبيب
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
