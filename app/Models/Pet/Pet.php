<?php

namespace App\Models\Pet;

use App\Models\Client\Client;
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

    /** @use HasFactory<PetFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'pets';

    protected $fillable = [
        'name',
        'client_id',
        'specie_id',
        'breed',
        'birth_date',
        'color',
        'size',
        'microchipped',
        'microchip_number',
    ];
    protected $casts = [
        'birth_date' => 'date',
        'microchipped' => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }
}
