<?php

namespace App\Models\Pet;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vacinations';

    protected $fillable = [
        'pet_id',
        'vaccine_name',
        'date_administered',
        'next_due_date',
        'performed_by',
        'lote',
        'manufacturer',
        'dosage',
    ];
    protected $dates = [
        'date_administered',
        'next_due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
