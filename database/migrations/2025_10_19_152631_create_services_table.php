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
            $table->id()
                ->autoIncrement();
            $table->string('name', 255)
                ->index();
            $table->string('slug')
                ->index();
            $table->string('thumbnail_url', 255)
                ->nullable();
            $table->string('image_url', 255)
                ->nullable();
            $table->text('description');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')
                ->nullable()
                ->index()
                ->constrained('users');
            $table->foreignId('updated_by')
                ->nullable()
                ->index()
                ->constrained('users');
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
