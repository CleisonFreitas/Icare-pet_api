<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->string('medical_care')->nullable();
            $table->string('medical_care_type')->nullable();
            $table->text('medical_care_details')->nullable();
            $table->foreignId('treated_by')->constrained('users')->nullable();
            $table->float('weight')->nullable();
            $table->float('body_temperature')->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->text('main_complaint')->nullable();
            $table->date('next_appointment')->nullable();
            $table->text('clinical_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
