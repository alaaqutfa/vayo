<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GuideCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'parent_id', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // العلاقة مع الخدمات
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id')->where('is_active', true)->orderBy('order');
    }

    // العلاقة مع الفئة الأم
    public function parent()
    {
        return $this->belongsTo(GuideCategory::class, 'parent_id');
    }

    // الفئات الفرعية
    public function children()
    {
        return $this->hasMany(GuideCategory::class, 'parent_id')->orderBy('order');
    }

    // نطاق الفئات النشطة
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // نطاق الفئات الجذرية (بدون أب)
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }
}
