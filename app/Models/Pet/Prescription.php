<?php

namespace App\Models\Pet;

use App\Models\Common\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prescriptions';

    protected $fillable = [
        'pet_id',
        'start_date',
        'medication',
        'dosage',
        'duration',
        'frequency',
        'refills', // Quantidade de aplicações
        'prescribed_by',
        'via_admin', // Via administrada
    ];

    protected $casts = [
        'start_date' => 'date',
        'refills' => 'integer',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function veterinarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prescribed_by');
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'origin');
    }
}