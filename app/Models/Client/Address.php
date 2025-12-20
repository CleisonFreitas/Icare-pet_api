<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = [
        'client_id',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'country',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}