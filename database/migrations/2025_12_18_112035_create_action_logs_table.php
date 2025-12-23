<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('log_name');
            $table->string('performed_type')->nullable();
            $table->unsignedBigInteger('performed_by')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
