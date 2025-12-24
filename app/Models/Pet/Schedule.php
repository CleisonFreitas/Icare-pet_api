<?php

namespace App\Models\Pet;

use App\Enums\Pets\StatusScheduleEnum;
use App\Models\Client\Client;
use App\Models\Common\Note;
use App\Traits\KeyEncrypter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes, KeyEncrypter;

    protected $table = 'schedules';

    protected $fillable = [
        'client_id',
        'pet_id',
        'scheduled_date',
        'service_type',
        'status',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'status' => StatusScheduleEnum::class,
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function note(): MorphMany
    {
        return $this->morphMany(Note::class, 'origin');
    }

    public function isOpen(): bool
    {
        return $this->status === StatusScheduleEnum::OPEN;
    }

    public function isPending(): bool
    {
        return $this->status === StatusScheduleEnum::PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status === StatusScheduleEnum::CONFIRMED;
    }

    public function isCanceled(): bool
    {
        return $this->status === StatusScheduleEnum::CANCELLED;
    }

    public function isCompleted(): bool
    {
        return $this->status === StatusScheduleEnum::COMPLETED;
    }
}