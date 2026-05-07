<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CleanUnusedImages extends Command
{
    protected $signature = 'images:clean {--dry-run : عرض الملفات المراد حذفها دون حذف فعلي}';
    protected $description = 'Delete unused images from storage (not linked to any database record)';

    public function handle()
    {
        $this->info('Scanning for unused images...');

        // جمع جميع مسارات الصور المستخدمة في قاعدة البيانات
        $usedPaths = [];

        // من خدمات
        foreach (Service::all() as $service) {
            if ($service->image) $usedPaths[] = $service->image;
        }

        // من تجارب
        foreach (Testimonial::all() as $testimonial) {
            if ($testimonial->image) $usedPaths[] = $testimonial->image;
        }

        // من معرض
        foreach (Gallery::all() as $gallery) {
            if ($gallery->image) $usedPaths[] = $gallery->image;
            if ($gallery->before_image) $usedPaths[] = $gallery->before_image;
            if ($gallery->after_image) $usedPaths[] = $gallery->after_image;
        }

        // من صفحات
        foreach (Page::all() as $page) {
            if ($page->featured_image) $usedPaths[] = $page->featured_image;
        }

        // الحصول على جميع الملفات في مجلد التخزين (public)
        $allFiles = Storage::disk('public')->allFiles();

        // التنظيف
        $deletedCount = 0;
        $dryRun = $this->option('dry-run');

        foreach ($allFiles as $file) {
            // تجاهل بعض المجلدات مثل vendor, css, js
            if (str_starts_with($file, 'css/') || str_starts_with($file, 'js/') || str_starts_with($file, 'vendor/')) {
                continue;
            }

            if (!in_array($file, $usedPaths)) {
                if ($dryRun) {
                    $this->line("Would delete: {$file}");
                } else {
                    Storage::disk('public')->delete($file);
                    $this->line("Deleted: {$file}");
                }
                $deletedCount++;
            }
        }

        if ($dryRun) {
            $this->info("Dry run: {$deletedCount} files would be deleted.");
        } else {
            $this->info("Cleanup completed: {$deletedCount} files deleted.");
        }
    }
}
