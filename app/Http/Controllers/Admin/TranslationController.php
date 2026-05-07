<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Translation;
use App\Helpers\TranslationHelper;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('locale', app()->getLocale());
        $languages = Language::where('is_active', true)->get();

        $translations = Translation::where('lang', $locale)->orderBy('key')->paginate(50);

        return view('admin.translations.index', compact('translations', 'locale', 'languages'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'translations' => 'required|array',
            'translations.*' => 'nullable|string',
            'locale' => 'required|string|exists:languages,code',
        ]);

        foreach ($request->translations as $key => $value) {
            Translation::updateOrCreate(
                ['lang' => $request->input('locale'), 'key' => $key],
                ['value' => $value]
            );
        }

        // مسح الكاش
        TranslationHelper::clearCache($request->input('locale'));

        return redirect()->route('admin.translations.index', ['locale' => $request->input('locale')])
            ->with('success', 'Translations updated successfully.');
    }

    public function createKey(Request $request)
    {
        $request->validate([
            'locale' => 'required|string|exists:languages,code',
            'key' => 'required|string|unique:translations,key,NULL,id,lang,'.$request->input('locale'),
            'value' => 'nullable|string',
        ]);

        Translation::create([
            'lang' => $request->input('locale'),
            'key' => $request->key,
            'value' => $request->value,
        ]);

        TranslationHelper::clearCache($request->input('locale'));

        return redirect()->route('admin.translations.index', ['locale' => $request->input('locale')])
            ->with('success', 'New translation key added.');
    }

    public function destroy($id)
    {
        $translation = Translation::findOrFail($id);
        $locale = $translation->lang;
        $translation->delete();
        TranslationHelper::clearCache($locale);
        return redirect()->route('admin.translations.index', ['locale' => $locale])
            ->with('success', 'Translation deleted.');
    }
}
