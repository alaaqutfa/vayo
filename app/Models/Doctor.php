<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'bio',
        'image',
        'email',
        'phone',
        'years_experience',
        'rating',
        'reviews_count',
        'status',
        'service_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'rating'           => 'decimal:1',
        'years_experience' => 'integer',
        'reviews_count'    => 'integer',
    ];

    // العلاقة مع الخدمة (اختياري)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'doctor_service');
    }

    // نطاقات
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeBySpecialty($query, $specialty)
    {
        if ($specialty) {
            return $query->where('specialty', $specialty);
        }
        return $query;
    }

    // مساعد للحصول على رابط الصورة
    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image) : asset('assets/img/health/default.jpg');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
