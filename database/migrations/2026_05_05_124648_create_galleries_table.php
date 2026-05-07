<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');                    // مسار الصورة
            $table->string('before_image')->nullable(); // صورة قبل
            $table->string('after_image')->nullable();  // صورة بعد
            $table->enum('type', ['image', 'video'])->default('image');
            $table->string('video_url')->nullable(); // رابط يوتيوب (إذا كان فيديو)
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
