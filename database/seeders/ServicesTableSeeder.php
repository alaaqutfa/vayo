<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'        => 'Hollywood Smile',
                'slug'        => 'hollywood-smile',
                'description' => 'Transform your smile with a custom-designed Hollywood Smile makeover using premium veneers and aesthetic dentistry techniques.',
                'icon'        => 'bi bi-emoji-sunglasses',
                'image'       => 'assets/img/services/dental-smile-treatment-2.webp',
                'features'    => ['Personalized Smile Design', 'High-Quality Materials', 'Natural Appearance', 'Long-Lasting Results'],
                'is_active'   => true,
                'order'       => 1,
            ],
            [
                'name'        => 'Single Implant Dental Treatment',
                'slug'        => 'single-implant-dental-treatment',
                'description' => 'Replace a missing tooth with a durable, natural-looking dental implant at Suave Clinic.',
                'icon'        => 'bi bi-eye',
                'image'       => 'assets/img/services/suave-dental-clinic.webp',
                'features'    => ['Single Tooth Replacement', 'Bone Preservation', 'Natural Feel & Function', 'High Success Rate'],
                'is_active'   => true,
                'order'       => 2,
            ],
            [
                'name'        => 'Dental Implant',
                'slug'        => 'dental-implant',
                'description' => 'Permanent solution for missing teeth using high-quality titanium implants that fuse with your jawbone.',
                'icon'        => 'bi bi-tools',
                'image'       => 'assets/img/services/all-on-4-all-on-6-dental-implants.webp',
                'features'    => ['Durable & Long-Lasting', 'Prevents Bone Loss', 'Restores Chewing Function', 'Natural Look'],
                'is_active'   => true,
                'order'       => 3,
            ],
            [
                'name'        => 'All-on-4 / All-on-6 Full Mouth Dental Implants',
                'slug'        => 'all-on-4-all-on-6-full-mouth-implants',
                'description' => 'Full arch restoration using 4 or 6 strategically placed implants to support a fixed prosthesis.',
                'icon'        => 'bi bi-grid-3x3-gap-fill',
                'image'       => 'assets/img/services/all-on-4-all-on-6-dental-implants.webp',
                'features'    => ['Full Mouth Reconstruction', 'Same-Day Teeth Option', 'Stable & Secure', 'Cost-Effective'],
                'is_active'   => true,
                'order'       => 4,
            ],
            [
                'name'        => 'All on 4 / 6 Implants',
                'slug'        => 'all-on-4-6-implants',
                'description' => 'Specialized implant technique for full arch rehabilitation, offering immediate function and aesthetics.',
                'icon'        => 'bi bi-brightness-alt-high',
                'image'       => 'assets/img/services/all-on-4-all-on-6-dental-implants.webp',
                'features'    => ['Minimally Invasive', 'Reduced Treatment Time', 'Fixed Prosthesis', 'High Stability'],
                'is_active'   => true,
                'order'       => 5,
            ],
            [
                'name'        => 'Laminate Dental Veneers',
                'slug'        => 'laminate-dental-veneers',
                'description' => 'Ultra-thin porcelain shells bonded to the front of teeth to correct shape, color, and alignment.',
                'icon'        => 'bi bi-gem',
                'image'       => 'assets/img/services/dental-veneers-treatment.webp',
                'features'    => ['Stain-Resistant', 'Minimal Tooth Preparation', 'Natural Translucency', 'Custom Shade Matching'],
                'is_active'   => true,
                'order'       => 6,
            ],
            [
                'name'        => 'Dental Crowns & Bridges',
                'slug'        => 'dental-crowns-bridges',
                'description' => 'Restore damaged teeth or replace missing teeth with custom-crafted crowns and fixed bridges.',
                'icon'        => 'bi bi-brightness-high',
                'image'       => 'assets/img/services/dental-crown-and-bridges.webp',
                'features'    => ['Strength & Durability', 'Aesthetic Materials', 'Prevents Shifting', 'Long-Term Solution'],
                'is_active'   => true,
                'order'       => 7,
            ],
            [
                'name'        => 'Gum Aesthetics',
                'slug'        => 'gum-aesthetics',
                'description' => 'Enhance your smile with gum contouring, crown lengthening, and other periodontal plastic surgeries.',
                'icon'        => 'bi bi-heart',
                'image'       => 'assets/img/services/suave-dental-clinic.webp',
                'features'    => ['Gummy Smile Correction', 'Receding Gum Treatment', 'Harmonious Smile Line', 'Minimally Invasive'],
                'is_active'   => true,
                'order'       => 8,
            ],
            [
                'name'        => 'Invisalign',
                'slug'        => 'invisalign',
                'description' => 'Straighten misaligned teeth discreetly with clear, removable aligners custom-made for you.',
                'icon'        => 'bi bi-bezier2',
                'image'       => 'assets/img/services/misalignment-teeth-treatment-with-invisalign.webp',
                'features'    => ['Nearly Invisible', 'Removable for Eating', 'No Metal Brackets', 'Predictable Results'],
                'is_active'   => true,
                'order'       => 9,
            ],
            [
                'name'        => 'Pulp Therapy',
                'slug'        => 'pulp-therapy',
                'description' => 'Treat inflamed or infected dental pulp to save natural teeth and relieve pain.',
                'icon'        => 'bi bi-droplet-half',
                'image'       => 'assets/img/services/root-canal-treatment.webp',
                'features'    => ['Pain Relief', 'Preserves Natural Tooth', 'Root Canal Treatment', 'Pulpotomy for Children'],
                'is_active'   => true,
                'order'       => 10,
            ],
            [
                'name'        => 'Teeth Whitening',
                'slug'        => 'teeth-whitening',
                'description' => 'Professional teeth whitening treatment at Suave Clinic for a brighter, more confident smile.',
                'icon'        => 'bi bi-brightness-alt-high',
                'image'       => 'assets/img/services/teeth-whitening-treatment.webp',
                'features'    => ['In-Office Whitening', 'Take-Home Kits', 'Visible Results in One Session', 'Safe & Effective'],
                'is_active'   => true,
                'order'       => 11,
            ],
            [
                'name'        => 'Removable Dentures',
                'slug'        => 'removable-dentures',
                'description' => 'Full or partial removable dentures to restore missing teeth and improve function.',
                'icon'        => 'bi bi-box-seam',
                'image'       => 'assets/img/services/removable-dentures.webp',
                'features'    => ['Affordable Solution', 'Custom Fit', 'Easy to Clean', 'Aesthetic Appearance'],
                'is_active'   => true,
                'order'       => 12,
            ],
            [
                'name'        => 'Scaling & Polishing',
                'slug'        => 'scaling-polishing',
                'description' => 'Professional dental cleaning to remove plaque, tartar, and stains for optimal oral health.',
                'icon'        => 'bi bi-brush',
                'image'       => 'assets/img/services/dental-scaling-and-polishing.webp',
                'features'    => ['Removes Plaque & Tartar', 'Prevents Gum Disease', 'Freshens Breath', 'Polishes Teeth'],
                'is_active'   => true,
                'order'       => 13,
            ],
            [
                'name'        => 'Teeth Extraction',
                'slug'        => 'teeth-extraction',
                'description' => 'Safe and gentle tooth extraction for problematic teeth, including wisdom teeth removal and oral surgeries.',
                'icon'        => 'bi bi-scissors',
                'image'       => 'assets/img/services/dental-teeth-extractions-oral-surgeries.webp',
                'features'    => ['Simple & Surgical Extractions', 'Wisdom Tooth Removal', 'Pain Management', 'Post-Operative Care'],
                'is_active'   => true,
                'order'       => 14,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
