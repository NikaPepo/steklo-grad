<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id()
                ->autoIncrement();
            $table->string('name', 255)
                ->index();
            $table->string('slug', 255)
                ->index()
                ->nullable();
            $table->string('thumbnail_url', 255)
                ->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_visible')
                ->default(true)
                ->index();
            $table->boolean('is_video')->default(false);
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
        Schema::dropIfExists('albums');
    }
};
