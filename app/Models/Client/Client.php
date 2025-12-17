<?php

namespace App\Models\Client;

use Database\Factories\Client\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    /** @use HasFactory<ClientFactory> */
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'birthdate',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
    ];
}