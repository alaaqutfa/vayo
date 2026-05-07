<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    // مساعد لجلب قيمة إعداد معين
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        if (! $setting) {
            return $default;
        }

        switch ($setting->type) {
            case 'image':
                return $setting->value ? asset('storage/' . $setting->value) : $default;
            case 'color':
                return $setting->value ?: $default;
            case 'boolean':
                return filter_var($setting->value, FILTER_VALIDATE_BOOL);
            default:
                return $setting->value ?: $default;
        }
    }

    // مساعد لتحديث أو إنشاء إعداد
    public static function setValue(string $key, $value, string $type = 'text')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}
