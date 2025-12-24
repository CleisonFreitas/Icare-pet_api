<?php
namespace App\Http\Requests\App;

use App\Http\Requests\BaseRequest;
use App\Models\Pet\Schedule;
use Illuminate\Validation\Rule;

class ScheduleRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'schedule_id' => ['required', Rule::exists(Schedule::class, 'id')],
        ];
    }

    public function attributes(): array
    {
        return [
            'schedule_id' => 'data do agendamento'
        ];
    }
}