<?php

namespace App\Models\Financial;

use App\Enums\Financial\PaymentMethodEnum;
use App\Enums\Financial\StatusPaymentEnum;
use App\Enums\Financial\TransactionTypeEnum;
use App\Models\Client\Client;
use App\Models\Pet\Pet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialControl extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'financial_control';

    protected $fillable = [
        'client_id',
        'pet_id',
        'transaction_type',
        'amount',
        'date',
        'description',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'decimal:2',
        'transaction_type' => TransactionTypeEnum::class,
        'status' => StatusPaymentEnum::class,
        'payment_method' => PaymentMethodEnum::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}