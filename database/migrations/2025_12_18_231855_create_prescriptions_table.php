<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets');
            $table->date('start_date');
            $table->string('medication');
            $table->decimal('dosage', 10, 2);
            $table->string('duration');
            $table->string('frequency');
            $table->integer('refills')->comment('Quantidade de aplicações');
            $table->foreignId('prescribed_by')->constrained('users');
            $table->string('via_admin')->comment('Via administrada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
