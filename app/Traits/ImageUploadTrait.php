<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ImageUploadTrait
{
    /**
     * رفع صورة واحدة
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int|null $width
     * @param int|null $height
     * @param bool $crop
     * @return string
     */
    public function uploadImage($file, $folder = 'general', $width = null, $height = null, $crop = false)
    {
        // اسم فريد للملف
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $fileName;

        // معالجة الصورة
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        if ($width && $height) {
            if ($crop) {
                $image->cover($width, $height);
            } else {
                // Manually preserve aspect ratio and prevent upscaling
                $origW = $image->width();
                $origH = $image->height();
                if ($origW > 0 && $origH > 0) {
                    $ratio = min($width / $origW, $height / $origH, 1);
                    $newW = (int) round($origW * $ratio);
                    $newH = (int) round($origH * $ratio);
                    $image->resize($newW, $newH);
                }
            }
        }

        // ضغط الجودة (إذا كانت الصورة JPEG أو PNG)
        $quality = 85;
        $encoded = $image->toJpeg($quality);

        // حفظ الصورة
        Storage::disk('public')->put($path, $encoded);

        return $path;
    }

    /**
     * رفع صورة قبل/بعد (Gallery)
     *
     * @param UploadedFile|null $file
     * @param string $folder
     * @param string|null $oldFile
     * @return string|null
     */
    public function uploadBeforeAfterImage($file, $folder = 'gallery/beforeafter', $oldFile = null)
    {
        if (!$file) return null;

        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }

        return $this->uploadImage($file, $folder, 800, 600);
    }

    /**
     * رفع صورة خدمة (مع تحجيم مختلف)
     *
     * @param UploadedFile|null $file
     * @param string|null $oldFile
     * @return string|null
     */
    public function uploadServiceImage($file, $oldFile = null)
    {
        if (!$file) return null;

        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }

        return $this->uploadImage($file, 'services', 800, 600);
    }

    /**
     * رفع صورة تجربة عميل
     *
     * @param UploadedFile|null $file
     * @param string|null $oldFile
     * @return string|null
     */
    public function uploadTestimonialImage($file, $oldFile = null)
    {
        if (!$file) return null;

        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }

        return $this->uploadImage($file, 'testimonials', 200, 200, true); // مربعة
    }

    /**
     * حذف صورة من التخزين
     *
     * @param string|null $path
     * @return void
     */
    public function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * حذف كافة الصور المرتبطة بنموذج معين
     *
     * @param array $paths
     * @return void
     */
    public function deleteMultipleImages($paths)
    {
        foreach ($paths as $path) {
            $this->deleteImage($path);
        }
    }
}
