<?php

namespace App\Models\Pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breed extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'breeds';

    protected $fillable = [
        'name',
        'slug',
        'specie_id',
        'active'
    ];

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class);
    }
}
