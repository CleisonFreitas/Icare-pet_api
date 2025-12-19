<?php

namespace App\Models\Common;

use App\Enums\Logs\Note\SegmentNoteEnum;
use App\Models\Client\Client;
use App\Models\Pet\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notes';

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'client_id',
        'pet_id',
        'segment'
    ];

    protected $cast = [
        'segment' => SegmentNoteEnum::class,
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}