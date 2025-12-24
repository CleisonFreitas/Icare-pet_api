<?php
namespace App\Http\Requests\App;

use App\Http\Requests\BaseRequest;

class ScheduleManageRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'motive' => ['required', 'string'],
            'reschedule' => ['nullable', 'boolean']
        ];
    }
}