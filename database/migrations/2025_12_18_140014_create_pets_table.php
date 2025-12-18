<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('species_id')->constrained('species')->onDelete('cascade');
            $table->string('breed')->nullable();
            $table->string('size');
            $table->date('birth_date')->nullable();
            $table->string('color')->nullable();
            $table->boolean('microchipped')->default(false);
            $table->string('microchip_number')->nullable();
            $table->boolean('registered')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
