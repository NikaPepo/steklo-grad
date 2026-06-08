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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id()
                ->autoIncrement();
            $table->string('author', 255)
                ->index();
            $table->string('author_image_url', 255)
                ->nullable();
            $table->string('author_phone_number', 50);
            $table->date('date');
            $table->boolean('published')
                ->default(false)
                ->index();
            $table->text('text');
            $table->string('attachment_url', 255)
                ->nullable();
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
        Schema::dropIfExists('reviews');
    }
};
