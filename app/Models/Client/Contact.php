<?php

namespace App\Models\Client;

use App\Enums\Client\ContactTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'type',
        'value',
        'client_id'
    ];

    protected $casts = [
        'name' => 'string',
        'type' => ContactTypeEnum::class,
        'value' => 'string',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}