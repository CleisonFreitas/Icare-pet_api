<?php

use App\Enums\Pets\StatusScheduleEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients');
            $table->foreignId('pet_id')
                ->nullable()
                ->constrained('pets');
            $table->dateTime('scheduled_date');
            $table->string('service_type');
            $table->string('status')->default(StatusScheduleEnum::OPEN->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
