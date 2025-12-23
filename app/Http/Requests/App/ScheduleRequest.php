<?php
namespace App\Http\Requests\App;

use App\Enums\Pets\MedicalTypeEnum;
use App\Http\Requests\BaseRequest;
use App\Models\Pet\Pet;
use App\Models\Pet\Schedule;
use Illuminate\Validation\Rule;

class ScheduleRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'pet_id' => ['required', Rule::exists(Pet::class, 'id')],
            'schedule_id' => ['required', /* Rule::exists(Schedule::class, 'id') */],
        ];
    }

    public function attributes(): array
    {
        return [
            'pet_id' => 'pet',
            'schedule_id' => 'data do agendamento'
        ];
    }
}