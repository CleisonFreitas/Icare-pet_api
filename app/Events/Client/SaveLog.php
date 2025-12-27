<?php

namespace App\Events\Client;

use App\Models\Client\Client;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

class SaveLog
{
    public function __construct(
        private string $logName,
        private string $description,
        private string $performedType,
        private int $performedBy,
        private array $details = [],
    ) {}

    public function getLogName(): string
    {
        return $this->logName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPerformedBy(): int
    {
        return $this->performedBy;
    }

    public function getPerformedType(): string
    {
        return $this->performedType;
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public static function create(
        string $logName,
        string $description,
        array $details = []
    ): self
    {
        /** @var Client|User */
        $user = Auth::user();
        return new self(
            logName: $logName,
            description: $description,
            performedType: $user::class,
            performedBy: $user->id,
            details: $details
        );
    }
}
