<?php

namespace App\Models\Pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medical_records';

    protected $fillable = [
        'pet_id',
        'description',
        'date',
        'medical_care',
        'medical_care_type',
        'medical_care_details',
        'treated_by',
        'weight',
        'body_temperature',
        'heart_rate',
        'respiratory_rate',
        'main_complaint',
        'next_appointment',
        'clinical_notes',
    ];

    protected $casts = [
        'date' => 'date',
        'next_appointment' => 'date',
        'weight' => 'float',
        'body_temperature' => 'float',
        'heart_rate' => 'integer',
        'respiratory_rate' => 'integer',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}
