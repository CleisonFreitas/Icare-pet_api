<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets');
            $table->date('examination_date');
            $table->string('exame_type');
            $table->text('diagnosis');
            $table->date('required_date')->comment('Data da solicitação do exame');
            $table->date('result_date')->nullable();
            $table->foreignId('performed_by')->constrained('users');
            $table->string('file_result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
