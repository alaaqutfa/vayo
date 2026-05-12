<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'      => 'Sarah Johnson',
                'image'     => 'assets/img/person/person-f-11.webp',   // أنثى
                'position'  => 'Mother of 2',
                'content'   => 'The care I received at Vayu Clinic was exceptional. The doctors took time to explain everything and made me feel comfortable throughout my treatment.',
                'rating'    => 5,
                'is_active' => true,
                'order'     => 1,
            ],
            [
                'name'      => 'Michael Chen',
                'image'     => 'assets/img/person/person-m-7.webp',    // ذكر
                'position'  => 'Business Executive',
                'content'   => 'After struggling with chronic back pain for years, the orthopedic team finally provided a solution. I am now pain-free and active again. Highly recommend!',
                'rating'    => 5,
                'is_active' => true,
                'order'     => 2,
            ],
            [
                'name'      => 'David Williams',
                'image'     => 'assets/img/person/person-m-12.webp',   // ذكر
                'position'  => 'Retired Teacher',
                'content'   => 'The cardiology department saved my life. Quick diagnosis, excellent surgery, and wonderful follow-up care. Forever grateful.',
                'rating'    => 5,
                'is_active' => true,
                'order'     => 3,
            ],
            [
                'name'      => 'Emily Rodriguez',
                'image'     => 'assets/img/person/person-f-12.webp',   // أنثى
                'position'  => 'Fitness Trainer',
                'content'   => 'Vayu Clinic provides clear, coordinated medical care with experienced clinicians and modern diagnostics. The staff is friendly and professional.',
                'rating'    => 4,
                'is_active' => true,
                'order'     => 4,
            ],
            [
                'name'      => 'James Wilson',
                'image'     => 'assets/img/person/person-m-9.webp',    // ذكر
                'position'  => 'Software Engineer',
                'content'   => 'Great experience from start to finish. The online appointment system is convenient, and the doctors are top-notch.',
                'rating'    => 5,
                'is_active' => true,
                'order'     => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        $this->command->info('✅ Testimonials seeded with real person images from assets/img/person/');
    }
}
