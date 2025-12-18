<?php

namespace App\Enums\Logs\App\Pets;

enum MedicalTypeEnum: string
{
    case VACINACAO = 'VACINACAO';
    case TRATAMENTO = 'TRATAMENTO';
    case CONSULTA = 'CONSULTA';
    case CIRURGIA = 'CIRURGIA';
    case VERMIFUGACAO = 'VERMIFUGACAO';

    public function description(): string
    {
        return match ($this) {
            MedicalTypeEnum::VACINACAO => 'Vacinação',
            MedicalTypeEnum::TRATAMENTO => 'Tratamento',
            MedicalTypeEnum::CONSULTA => 'Consulta',
            MedicalTypeEnum::CIRURGIA => 'Cirurgia',
            MedicalTypeEnum::VERMIFUGACAO => 'Vermifugação',
        };
    }
}