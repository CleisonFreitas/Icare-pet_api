<?php

namespace App\Events\Client;

use App\Models\Client\Client;
use App\Models\User\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SaveLog
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public string $logName,
        public string $description,
        public string $performedType,
        public int $performedBy,
        public array $details = [],
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
    ): SaveLog
    {
        /** @var Client|User */
        $user = Auth::user();
        $log = new SaveLog(
            logName: $logName,
            description: $description,
            performedType: $user::class,
            performedBy: $user->id,
            details: $details
        );

        try {
            event($log);
        } catch (\Throwable $e) {
            logger()->error('Failed to dispatch SaveLog event: ' . $e->getMessage(), ['exception' => $e]);
        }

        return $log;
    }
}
