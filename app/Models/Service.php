<?php
namespace App\Models;

use App\Traits\HasMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'features',
        'is_active',
        'order',
    ];

    protected $casts = [
        'features'  => 'array', // سيتم تخزينها كـ JSON وتحويلها تلقائيًا إلى array
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(GuideCategory::class, 'category_id');
    }

    // Boot event لإنشاء slug تلقائيًا إذا لم يكن موجودًا
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_service');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
