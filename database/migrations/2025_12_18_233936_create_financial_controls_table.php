<?php

use App\Enums\Financial\StatusPaymentEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialControlsTable extends Migration
{
    public function up(): void
    {
        Schema::create('financial_control', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('pet_id')->constrained('pets');
            $table->string('transaction_type');
            $table->decimal('amount', 15, 2);
            $table->dateTime('release_date');
            $table->dateTime('payment_date')->nullable();
            $table->string('description')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->default(StatusPaymentEnum::PENDING->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_control');
    }
};
