<?php

namespace App\Models\Pet;

use App\Enums\Pets\GroupSpecieEnum;
use App\Traits\KeyEncrypter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specie extends Model
{
    use HasFactory, SoftDeletes, KeyEncrypter;

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
