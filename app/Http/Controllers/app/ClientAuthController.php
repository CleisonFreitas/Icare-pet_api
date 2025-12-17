<?php

declare(strict_types=1);

namespace App\Http\App\Controllers;

final class ClientAuthController
{
    public function login(): string
    {
        return 'Client login';
    }

    public function me(): string
    {
        return 'Client me';
    }

    public function logout(): string
    {
        return 'Client logout';
    }
}