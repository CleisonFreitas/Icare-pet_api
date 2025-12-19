<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets');
            $table->string('vaccine_name');
            $table->date('date_administered')->nullable();
            $table->date('next_due_date');
            $table->foreignId('performed_by')->constrained('users')->nullable();
            $table->string('lote')->nullable();
            $table->string('manufacturer')->nullable();
            $table->decimal('dosage', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacinations');
    }
};