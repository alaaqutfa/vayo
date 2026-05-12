<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name'       => 'Vayu Clinic',
            'primary_color'   => '#33FF99',
            'secondary_color' => '#012119',
            'contact_phone'   => '+90 555 057 65 55',
            'contact_email'   => 'info@vayuclinic.com',
            'contact_address' => 'Vayu Clinic Medical Center, Istanbul, Türkiye',
            'emergency_phone' => '+90 555 057 65 55',
            'footer_text'     => 'Providing modern, patient-centered healthcare through trusted specialists, clear communication, and coordinated care for every stage of life.',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value, 'text');
        }
    }
}
