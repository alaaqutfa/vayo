<?php

namespace Database\Seeders;

use App\Models\GuideCategory;
use App\Models\Service;
use Illuminate\Database\Seeder;

class GuideCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cosmetic Dentistry (الأب)
        $cosmetic = GuideCategory::updateOrCreate(
            ['slug' => 'cosmetic-dentistry'],
            [
                'name'        => 'Cosmetic Dentistry',
                'description' => 'Enhance your smile with our advanced cosmetic procedures.',
                'order'       => 1,
                'is_active'   => true,
            ]
        );

        // أبناء Cosmetic Dentistry
        $cosmeticChildren = [
            'Dental Veneers' => 'dental-veneers',
            'Dental Bonding' => 'dental-bonding',
            'Emax Veneers'   => 'emax-veneers',
            'Teeth Whitening' => 'teeth-whitening',
            'Hollywood Smile' => 'hollywood-smile',
            'Zirconia Veneers' => 'zirconia-veneers',
            'Dental Lumineers' => 'dental-lumineers',
            'Invisalign'       => 'invisalign',
            'Cosmetic Dentistry' => 'cosmetic-dentistry-service', // اسم عام
            'Cosmetic Gum Surgery' => 'cosmetic-gum-surgery',
        ];

        foreach ($cosmeticChildren as $childName => $childSlug) {
            GuideCategory::updateOrCreate(
                ['slug' => $childSlug],
                [
                    'name'        => $childName,
                    'parent_id'   => $cosmetic->id,
                    'order'       => array_search($childName, array_keys($cosmeticChildren)) + 1,
                    'is_active'   => true,
                ]
            );
        }

        // 2. Restorative Dentistry
        $restorative = GuideCategory::updateOrCreate(
            ['slug' => 'restorative-dentistry'],
            [
                'name'        => 'Restorative Dentistry',
                'description' => 'Restore function and beauty to your smile.',
                'order'       => 2,
                'is_active'   => true,
            ]
        );

        $restorativeChildren = [
            'Dental Crowns' => 'dental-crowns',
            'Dental Bridges' => 'dental-bridges',
            'Zirconia Crowns' => 'zirconia-crowns',
            'Ceramic Crowns' => 'ceramic-crowns',
            'Inlays & Onlays' => 'inlays-onlays',
            'Dental Fillings' => 'dental-fillings',
            'Dentures' => 'dentures',
        ];

        foreach ($restorativeChildren as $childName => $childSlug) {
            GuideCategory::updateOrCreate(
                ['slug' => $childSlug],
                [
                    'name'        => $childName,
                    'parent_id'   => $restorative->id,
                    'order'       => array_search($childName, array_keys($restorativeChildren)) + 1,
                    'is_active'   => true,
                ]
            );
        }

        // 3. Dental Implants
        $implants = GuideCategory::updateOrCreate(
            ['slug' => 'dental-implants'],
            [
                'name'        => 'Dental Implants',
                'description' => 'Permanent tooth replacement solutions.',
                'order'       => 3,
                'is_active'   => true,
            ]
        );

        $implantsChildren = [
            'Dental Implants' => 'dental-implants-service',
            'All-On-4 Dental Implants' => 'all-on-4',
            'Dental Bone Graft & Membrane' => 'bone-graft',
            'Sinus Lifts' => 'sinus-lifts',
            'Full-mouth Implants' => 'full-mouth-implants',
        ];

        foreach ($implantsChildren as $childName => $childSlug) {
            GuideCategory::updateOrCreate(
                ['slug' => $childSlug],
                [
                    'name'        => $childName,
                    'parent_id'   => $implants->id,
                    'order'       => array_search($childName, array_keys($implantsChildren)) + 1,
                    'is_active'   => true,
                ]
            );
        }

        // 4. Oral Health
        $oral = GuideCategory::updateOrCreate(
            ['slug' => 'oral-health'],
            [
                'name'        => 'Oral Health',
                'description' => 'Preventive care and routine procedures.',
                'order'       => 4,
                'is_active'   => true,
            ]
        );

        $oralChildren = [
            'Dental Cleaning' => 'dental-cleaning',
            'Root Canal Treatment' => 'root-canal',
            'Tooth Extraction' => 'tooth-extraction',
            'Wisdom Tooth Removal' => 'wisdom-tooth-removal',
            'Gum Contouring Surgery' => 'gum-contouring',
        ];

        foreach ($oralChildren as $childName => $childSlug) {
            GuideCategory::updateOrCreate(
                ['slug' => $childSlug],
                [
                    'name'        => $childName,
                    'parent_id'   => $oral->id,
                    'order'       => array_search($childName, array_keys($oralChildren)) + 1,
                    'is_active'   => true,
                ]
            );
        }

        // ربط الخدمات (Services) بالتصنيفات الفرعية (يمكنك ربط كل خدمة بالـ category_id المناسب)
        // هذا يعتمد على أن لديك Services موجودة مسبقاً. إذا لم تكن موجودة، سيتم إنشاء خدمات تجريبية.
        $this->attachServicesToCategories();
    }

    private function attachServicesToCategories()
    {
        // قائمة الخدمات مع slug التصنيف المرتبط
        $serviceMappings = [
            // Cosmetic children
            ['name' => 'Dental Veneers', 'slug' => 'dental-veneers', 'category_slug' => 'dental-veneers'],
            ['name' => 'Dental Bonding', 'slug' => 'dental-bonding', 'category_slug' => 'dental-bonding'],
            ['name' => 'Emax Veneers', 'slug' => 'emax-veneers', 'category_slug' => 'emax-veneers'],
            ['name' => 'Teeth Whitening', 'slug' => 'teeth-whitening', 'category_slug' => 'teeth-whitening'],
            ['name' => 'Hollywood Smile', 'slug' => 'hollywood-smile', 'category_slug' => 'hollywood-smile'],
            ['name' => 'Zirconia Veneers', 'slug' => 'zirconia-veneers', 'category_slug' => 'zirconia-veneers'],
            ['name' => 'Dental Lumineers', 'slug' => 'dental-lumineers', 'category_slug' => 'dental-lumineers'],
            ['name' => 'Invisalign', 'slug' => 'invisalign', 'category_slug' => 'invisalign'],
            ['name' => 'Cosmetic Dentistry', 'slug' => 'cosmetic-dentistry-service', 'category_slug' => 'cosmetic-dentistry-service'],
            ['name' => 'Cosmetic Gum Surgery', 'slug' => 'cosmetic-gum-surgery', 'category_slug' => 'cosmetic-gum-surgery'],
            // Restorative
            ['name' => 'Dental Crowns', 'slug' => 'dental-crowns', 'category_slug' => 'dental-crowns'],
            ['name' => 'Dental Bridges', 'slug' => 'dental-bridges', 'category_slug' => 'dental-bridges'],
            ['name' => 'Zirconia Crowns', 'slug' => 'zirconia-crowns', 'category_slug' => 'zirconia-crowns'],
            ['name' => 'Ceramic Crowns', 'slug' => 'ceramic-crowns', 'category_slug' => 'ceramic-crowns'],
            ['name' => 'Inlays & Onlays', 'slug' => 'inlays-onlays', 'category_slug' => 'inlays-onlays'],
            ['name' => 'Dental Fillings', 'slug' => 'dental-fillings', 'category_slug' => 'dental-fillings'],
            ['name' => 'Dentures', 'slug' => 'dentures', 'category_slug' => 'dentures'],
            // Implants
            ['name' => 'Dental Implants', 'slug' => 'dental-implants-service', 'category_slug' => 'dental-implants-service'],
            ['name' => 'All-On-4 Dental Implants', 'slug' => 'all-on-4', 'category_slug' => 'all-on-4'],
            ['name' => 'Dental Bone Graft & Membrane', 'slug' => 'bone-graft', 'category_slug' => 'bone-graft'],
            ['name' => 'Sinus Lifts', 'slug' => 'sinus-lifts', 'category_slug' => 'sinus-lifts'],
            ['name' => 'Full-mouth Implants', 'slug' => 'full-mouth-implants', 'category_slug' => 'full-mouth-implants'],
            // Oral health
            ['name' => 'Dental Cleaning', 'slug' => 'dental-cleaning', 'category_slug' => 'dental-cleaning'],
            ['name' => 'Root Canal Treatment', 'slug' => 'root-canal', 'category_slug' => 'root-canal'],
            ['name' => 'Tooth Extraction', 'slug' => 'tooth-extraction', 'category_slug' => 'tooth-extraction'],
            ['name' => 'Wisdom Tooth Removal', 'slug' => 'wisdom-tooth-removal', 'category_slug' => 'wisdom-tooth-removal'],
            ['name' => 'Gum Contouring Surgery', 'slug' => 'gum-contouring', 'category_slug' => 'gum-contouring'],
        ];

        foreach ($serviceMappings as $serviceData) {
            $category = GuideCategory::where('slug', $serviceData['category_slug'])->first();
            if ($category) {
                Service::updateOrCreate(
                    ['slug' => $serviceData['slug']],
                    [
                        'name'         => $serviceData['name'],
                        'description'  => 'Detailed description for ' . $serviceData['name'],
                        'category_id'  => $category->id,
                        'is_active'    => true,
                        'order'        => 1,
                    ]
                );
            }
        }
    }
}
