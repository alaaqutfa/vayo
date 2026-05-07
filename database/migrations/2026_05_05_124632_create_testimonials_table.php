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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // اسم العميل
            $table->string('position')->nullable(); // وظيفته أو حالته (مثل "مريض")
            $table->text('content');                // نص الشهادة
            $table->string('image')->nullable();    // صورة العميل
            $table->integer('rating')->default(5);  // تقييم من 1 إلى 5
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
        Schema::dropIfExists('testimonials');
    }
};
