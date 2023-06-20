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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('name');
            $table->string('link');
            $table->integer('status')->default(1);
            $table->integer('order')->nullable();
            $table->string('class')->nullable();
            $table->integer('sort')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->enum('show_place', ['footer_menu', 'header_menu', 'social_menu', 'footer_menu1', 'footer_menu2', 'footer_portal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
