<?php

namespace App\Models\Pet;

use App\Enums\Logs\App\Pets\GroupSpecieEnum;
use Database\Factories\Pet\SpecieFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specie extends Model
{
    /** @use HasFactory<SpecieFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'group',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'group' => GroupSpecieEnum::class,
    ];
}
