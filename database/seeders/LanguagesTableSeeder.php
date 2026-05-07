<?php
namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'code' => 'en', 'is_active' => true, 'is_default' => true],
            ['name' => 'العربية', 'code' => 'ar', 'is_active' => true, 'is_default' => false],
            ['name' => 'Français', 'code' => 'fr', 'is_active' => true, 'is_default' => false],
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate(['code' => $language['code']], $language);
        }
    }
}
