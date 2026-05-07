<?php
namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\Doctor;
use App\Models\Service;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AppointmentsAndMessagesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // الحصول على أقسام حقيقية من جدول services (إذا وجدت)
        $serviceIds  = Service::pluck('id')->toArray();
        $hasServices = ! empty($serviceIds);

        // الحصول على معرفات الأطباء من جدول doctors (يجب تشغيل DoctorsTableSeeder أولاً)
        $doctorIds  = Doctor::pluck('id')->toArray();
        $hasDoctors = ! empty($doctorIds);

        $statuses = ['pending', 'confirmed', 'cancelled'];

        // إنشاء 50 موعدًا مرتبطًا بالأطباء (بدون عمود time)
        for ($i = 0; $i < 15; $i++) {
            Appointment::create([
                'name'       => $faker->name(),
                'email'      => $faker->safeEmail(),
                'phone'      => $faker->phoneNumber(),
                'department' => $hasServices ? $faker->optional(0.7)->randomElement($serviceIds) : null,
                'date'       => $faker->dateTimeBetween('-1 month', '+2 months')->format('Y-m-d'),
                'doctor_id'  => $hasDoctors ? $faker->randomElement($doctorIds) : null,
                'message'    => $faker->optional(0.5)->sentence(10),
                'status'     => $faker->randomElement($statuses),
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => now(),
            ]);
        }

        // إنشاء 10 رسائل اتصال
        for ($i = 0; $i < 10; $i++) {
            ContactMessage::create([
                'name'       => $faker->name(),
                'email'      => $faker->safeEmail(),
                'subject'    => $faker->sentence(4),
                'message'    => $faker->paragraph(3),
                'is_read'    => $faker->boolean(40),
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Created 15 appointments linked to doctors (without time) and 10 contact messages.');
    }
}
