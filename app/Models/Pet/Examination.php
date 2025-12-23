<?php

namespace App\Models\Pet;

use App\Models\Common\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'examinations';

    protected $fillable = [
        'pet_id',
        'examination_date',
        'exame_type',
        'diagnosis',
        'required_date', // Data da solicitação do exame
        'result_date',
        'performed_by',
        'file_result',
    ];

    protected $dates = [
        'examination_date',
        'required_date',
        'result_date',
        'created_at',
        'updated_at',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

        public function note(): MorphMany
    {
        return $this->morphMany(Note::class, 'origin');
    }
}