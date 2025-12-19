<?php

namespace App\Enums\Pets;

enum MedicalTypeEnum: string
{
    case VACCINATION = 'VACCINATION';
    case TREATMENT = 'TREATMENT';
    case CONSULTATION = 'CONSULTATION';
    case SURGERY = 'SURGERY';
    case DEWORMING = 'DEWORMING';

    public function description(): string
    {
        return match ($this) {
            MedicalTypeEnum::VACCINATION => 'Vacinação',
            MedicalTypeEnum::TREATMENT => 'Tratamento',
            MedicalTypeEnum::CONSULTATION => 'Consulta',
            MedicalTypeEnum::SURGERY => 'SURGERY',
            MedicalTypeEnum::DEWORMING => 'Vermifugação',
        };
    }
}
