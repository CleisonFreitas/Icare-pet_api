<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients');
            $table->foreignId('pet_id')
                ->nullable()
                ->constrained('pets');
            $table->morphs('origin');
            $table->string('segment');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
