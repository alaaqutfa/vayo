<?php
namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title'        => 'Dental Implant Before & After',
                'type'         => 'image',
                'image'        => 'assets/img/gallery/default.webp',
                'before_image' => 'assets/img/gallery/default.webp',
                'after_image'  => 'assets/img/gallery/default.webp',
                'video_url'    => null,
                'description'  => 'Successful dental implant transformation',
                'is_active'    => true,
                'order'        => 1,
            ],
            [
                'title'        => 'Smile Makeover',
                'type'         => 'image',
                'image'        => 'assets/img/gallery/default.webp',
                'before_image' => 'assets/img/gallery/default.webp',
                'after_image'  => 'assets/img/gallery/default.webp',
                'video_url'    => null,
                'description'  => 'Complete smile makeover with veneers',
                'is_active'    => true,
                'order'        => 2,
            ],
            [
                'title'        => 'Orthodontic Treatment',
                'type'         => 'image',
                'image'        => 'assets/img/gallery/default.webp',
                'before_image' => 'assets/img/gallery/default.webp',
                'after_image'  => 'assets/img/gallery/default.webp',
                'video_url'    => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // رابط تجريبي
                'description'  => 'Watch our orthodontic procedure',
                'is_active'    => true,
                'order'        => 3,
            ],
            [
                'title'        => 'Clinic Tour',
                'type'         => 'video',
                'image'        => null,
                'before_image' => null,
                'after_image'  => null,
                'video_url'    => 'https://www.youtube.com/watch?v=Y7f98aduVJ8',
                'description'  => 'Take a tour of our state-of-the-art facility',
                'is_active'    => true,
                'order'        => 4,
            ],
        ];

        foreach ($items as $item) {
            Gallery::create($item);
        }
    }
}
