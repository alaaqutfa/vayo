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
        Schema::table('appointments', function (Blueprint $table) {
            // حذف عمود doctor القديم إذا كان موجودًا
            if (Schema::hasColumn('appointments', 'doctor')) {
                $table->dropColumn('doctor');
            }
            // إضافة doctor_id
            $table->unsignedBigInteger('doctor_id')->nullable()->after('department');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropColumn('doctor_id');
            $table->string('doctor')->nullable();
        });
    }
};
