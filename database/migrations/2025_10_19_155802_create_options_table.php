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
        Schema::create('options', function (Blueprint $table) {
            $table->id()
                ->autoIncrement();
            $table->string('name', 255)
                ->index();
            $table->string('value',255);
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
        Schema::dropIfExists('options');
    }
};
