<?php

namespace App\Models\Client;

use App\Models\Pet\Pet;
use App\Traits\KeyEncrypter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, KeyEncrypter;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'birth_date',
        'active',
        'register_completed',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'password' => 'hashed',
        'active' => 'boolean',
        'register_completed' => 'boolean',
    ];

    protected $hidden = [
        'password',
    ];
    
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'client_id')->with('specie');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_id');
    }
}