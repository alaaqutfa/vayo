<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
            'primary_color' => 'nullable|string|regex:/^#([A-Fa-f0-9]{6})$/',
            'secondary_color' => 'nullable|string|regex:/^#([A-Fa-f0-9]{6})$/',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_address' => 'nullable|string',
            'emergency_phone' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'social_tiktok' => 'nullable|url',
            'social_whatsapp' => 'nullable|string',
        ]);

        // حفظ النصوص
        $textKeys = ['site_name', 'contact_phone', 'contact_email', 'contact_address', 'emergency_phone', 'footer_text'];
        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::setValue($key, $request->input($key), 'text');
            }
        }

        // حفظ روابط التواصل الاجتماعي (فقط إذا كانت صحيحة)
        $socialKeys = ['social_facebook', 'social_twitter', 'social_instagram', 'social_linkedin', 'social_youtube', 'social_tiktok', 'social_whatsapp'];
        foreach ($socialKeys as $key) {
            if ($request->has($key)) {
                Setting::setValue($key, $request->input($key), 'text');
            }
        }

        // حفظ الألوان
        $colorKeys = ['primary_color', 'secondary_color'];
        foreach ($colorKeys as $key) {
            if ($request->has($key)) {
                Setting::setValue($key, $request->input($key), 'color');
            }
        }

        // رفع الشعار
        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::getValue('site_logo', null);
            if ($oldLogo && strpos($oldLogo, '/storage/') !== false) {
                $oldPath = str_replace('/storage/', '', $oldLogo);
                $this->deleteImage($oldPath);
            }
            $path = $this->uploadImage($request->file('site_logo'), 'settings', null, null, false);
            Setting::setValue('site_logo', $path, 'image');
        }

        // رفع الفافيكون
        if ($request->hasFile('favicon')) {
            $oldFav = Setting::getValue('favicon', null);
            if ($oldFav && strpos($oldFav, '/storage/') !== false) {
                $oldPath = str_replace('/storage/', '', $oldFav);
                $this->deleteImage($oldPath);
            }
            $path = $this->uploadImage($request->file('favicon'), 'settings', null, null, false);
            Setting::setValue('favicon', $path, 'image');
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
