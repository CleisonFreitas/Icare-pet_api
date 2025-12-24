<?php

namespace App\Models\Pet;

use App\Models\Client\Client;
use App\Traits\KeyEncrypter;
use Database\Factories\Pet\PetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    public const SMALL = 'Small';
    public const MEDIUM = 'Medium';
    public const LARGE = 'Large';

    use HasFactory, SoftDeletes, KeyEncrypter;

    protected $table = 'pets';

    protected $fillable = [
        'name',
        'client_id',
        'specie_id',
        'birth_date',
        'color',
        'size',
        'microchipped',
        'microchip_number',
        'active'
    ];
    protected $casts = [
        'birth_date' => 'date',
        'microchipped' => 'boolean',
        'active' => 'boolean'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }
}
