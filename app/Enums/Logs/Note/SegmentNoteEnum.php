<?php
namespace App\Enums\Logs\Note;

enum SegmentNoteEnum: string
{
    case FINANCIAL = 'FINANCIAL';
    case SCHEDULE = 'SCHEDULE';
    case PRESCRIPTION = 'PRESCRIPTION';
    case MEDICAL_RECORD = 'MEDICAL_RECORD';
    case EXAME = 'EXAME';
    case SERVICE = 'SERVICE';
    
    public function description(): string
    {
        return match($this) {
            self::FINANCIAL => 'Financeiro',
            self::SCHEDULE => 'Agendamento',
            self::PRESCRIPTION => 'Prescrição',
            self::MEDICAL_RECORD => 'Histórico Clínico',
            self::EXAME => 'Exames',
            self::SERVICE => 'Serviços',
        };
    }
}