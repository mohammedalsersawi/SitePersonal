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
        Schema::create('uplodes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('اسم الملف الاصلي');
            $table->string('filename')->nullable()->comment('اسم الملف بعد التغير');;
            $table->string('path')->nullable()->comment('المسار');
            $table->string('full_original_path')->nullable()->comment('رابط الصورة كامل الاصلية');
            $table->string('full_large_path')->nullable();
            $table->string('file_type')->nullable();
            $table->integer('relation_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uplodes');
    }
};
