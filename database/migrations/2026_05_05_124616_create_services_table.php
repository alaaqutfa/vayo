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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // اسم الخدمة
            $table->string('slug')->unique();     // رابط SEO: cardiology
            $table->text('description');          // وصف الخدمة
            $table->string('icon')->nullable();   // أيقونة (FontAwesome أو Bootstrap Icons)
            $table->string('image')->nullable();  // صورة مصغرة
            $table->json('features')->nullable(); // قائمة الميزات (مخزنة كـ JSON)
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
        Schema::dropIfExists('services');
    }
};
