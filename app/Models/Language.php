<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'is_active',
        'is_default',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_default' => 'boolean',
    ];

    // علاقة: اللغة لها عدة ترجمات
    public function translations()
    {
        return $this->hasMany(Translation::class, 'lang', 'code');
    }

    // الـ scope للغة النشطة
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // الـ scope للغة الافتراضية
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
