<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            LanguagesTableSeeder::class,
            TranslationsTableSeeder::class,
            ServicesTableSeeder::class,
            TestimonialsTableSeeder::class,
            GalleriesTableSeeder::class,
            PagesTableSeeder::class,
            SettingsTableSeeder::class,
            GuideCategoriesSeeder::class,
            FaqsTableSeeder::class,
            AppointmentsAndMessagesSeeder::class,
            DoctorsTableSeeder::class,
        ]);
    }
}
