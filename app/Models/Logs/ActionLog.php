<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    protected $table = 'activity_log';

    protected $fillable = [
        'log_name',
        'description',
        'performed_type',
        'performed_by',
        'properties',
        'batch_uuid',
    ];
}
