<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    public function run(): void
    {
        // تعريف الأطباء (بياناتهم الأساسية)
        $doctorsData = [
            [
                'name'             => 'Dr. Amanda Foster',
                'specialty'        => 'Cardiology',
                'bio'              => 'Board-certified cardiologist with extensive experience in interventional cardiology.',
                'email'            => 'amanda.foster@vayoclinic.com',
                'phone'            => '+90 555 123 45 67',
                'years_experience' => 14,
                'rating'           => 4.9,
                'reviews_count'    => 127,
                'status'           => 'available',
                'order'            => 1,
                'image'            => 'assets/img/person/person-f-5.webp',
                'services_slugs'   => ['single-implant-dental-treatment', 'dental-implant'], // أسماء الخدمات
            ],
            [
                'name'             => 'Dr. Marcus Johnson',
                'specialty'        => 'Neurology',
                'bio'              => 'Leading neurologist specializing in stroke and movement disorders.',
                'email'            => 'marcus.johnson@vayoclinic.com',
                'phone'            => '+90 555 123 45 68',
                'years_experience' => 16,
                'rating'           => 4.8,
                'reviews_count'    => 89,
                'status'           => 'busy',
                'order'            => 2,
                'image'            => 'assets/img/person/person-m-3.webp',
                'services_slugs'   => ['scaling-polishing', 'teeth-whitening'],
            ],
            [
                'name'             => 'Dr. Rachel Williams',
                'specialty'        => 'Pediatrics',
                'bio'              => 'Compassionate pediatrician dedicated to child wellness.',
                'email'            => 'rachel.williams@vayoclinic.com',
                'phone'            => '+90 555 123 45 69',
                'years_experience' => 11,
                'rating'           => 5.0,
                'reviews_count'    => 203,
                'status'           => 'available',
                'order'            => 3,
                'image'            => 'assets/img/person/person-f-9.webp',
                'services_slugs'   => ['pulp-therapy', 'teeth-extraction'],
            ],
            [
                'name'             => 'Dr. David Chen',
                'specialty'        => 'Orthopedics',
                'bio'              => 'Expert in joint replacement and sports medicine.',
                'email'            => 'david.chen@vayoclinic.com',
                'phone'            => '+90 555 123 45 70',
                'years_experience' => 22,
                'rating'           => 4.7,
                'reviews_count'    => 156,
                'status'           => 'offline',
                'order'            => 4,
                'image'            => 'assets/img/person/person-m-7.webp',
                'services_slugs'   => ['all-on-4-all-on-6-full-mouth-implants', 'all-on-4-6-implants'],
            ],
            [
                'name'             => 'Dr. Victoria Torres',
                'specialty'        => 'Dermatology',
                'bio'              => 'Skin health specialist offering cosmetic and medical dermatology.',
                'email'            => 'victoria.torres@vayoclinic.com',
                'phone'            => '+90 555 123 45 71',
                'years_experience' => 9,
                'rating'           => 4.5,
                'reviews_count'    => 74,
                'status'           => 'available',
                'order'            => 5,
                'image'            => 'assets/img/person/person-f-11.webp',
                'services_slugs'   => ['laminate-dental-veneers', 'hollywood-smile', 'gum-aesthetics'],
            ],
            [
                'name'             => 'Dr. Benjamin Lee',
                'specialty'        => 'Oncology',
                'bio'              => 'Oncologist with focus on immunotherapy and precision medicine.',
                'email'            => 'benjamin.lee@vayoclinic.com',
                'phone'            => '+90 555 123 45 72',
                'years_experience' => 19,
                'rating'           => 4.9,
                'reviews_count'    => 194,
                'status'           => 'available',
                'order'            => 6,
                'image'            => 'assets/img/person/person-m-9.webp',
                'services_slugs'   => ['dental-crowns-bridges', 'removable-dentures'],
            ],
        ];

        foreach ($doctorsData as $data) {
            $servicesSlugs = $data['services_slugs'];
            unset($data['services_slugs']);

            $doctor = Doctor::updateOrCreate(
                ['email' => $data['email']],
                $data
            );

            // ربط الخدمات باستخدام الأسماء (slugs)
            $serviceIds = Service::whereIn('slug', $servicesSlugs)->pluck('id');
            $doctor->services()->sync($serviceIds);
        }

        $this->command->info('✅ Doctors seeded with service relationships.');
    }
}
