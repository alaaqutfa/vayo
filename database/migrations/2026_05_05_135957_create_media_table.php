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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('model_type'); // App\Models\Service, App\Models\Gallery, etc.
            $table->unsignedBigInteger('model_id');
            $table->string('collection_name'); // default, before_after, gallery, video_thumbnail
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->integer('size')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index(['model_type', 'model_id', 'collection_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
