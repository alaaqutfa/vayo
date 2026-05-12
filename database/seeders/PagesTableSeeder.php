<?php
namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title'            => 'About Us',
                'slug'             => 'about',
                'content'          => '<h1>About Vayu Clinic</h1><p>Vayu Clinic provides clear, coordinated medical care with experienced clinicians, modern diagnostics, and follow-up that keeps patients informed at every step. Our multidisciplinary team of specialists works collaboratively to ensure every patient receives comprehensive care tailored to their unique needs.</p><h2>Our Mission</h2><p>To provide exceptional healthcare services with compassion, integrity, and innovation, improving the quality of life for our community.</p>',
                'meta_title'       => 'About Vayu Clinic | Trusted Medical Care',
                'meta_description' => 'Learn about Vayu Clinic\'s mission, values, and commitment to providing high-quality healthcare.',
                'is_active'        => true,
                'order'            => 1,
            ],
            [
                'title'            => 'Privacy Policy',
                'slug'             => 'privacy',
                'content'          => '<h1>Privacy Policy</h1><p>This Privacy Policy describes how we collect, use, process, and disclose your information, including personal information, in conjunction with your access to and use of our services.</p><h2>Information We Collect</h2><p>We collect information to provide better services to our users...</p>',
                'meta_title'       => 'Privacy Policy - Vayu Clinic',
                'meta_description' => 'Read our privacy policy to understand how we protect your data.',
                'is_active'        => true,
                'order'            => 2,
            ],
            [
                'title'            => 'Terms of Service',
                'slug'             => 'terms',
                'content'          => '<h1>Terms of Service</h1><p>By accessing our website and services, you agree to be bound by these Terms of Service and all applicable laws and regulations.</p><h2>Use License</h2><p>Permission is granted to temporarily download one copy of the materials...</p>',
                'meta_title'       => 'Terms of Service - Vayu Clinic',
                'meta_description' => 'Read our terms of service before using our website.',
                'is_active'        => true,
                'order'            => 3,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
