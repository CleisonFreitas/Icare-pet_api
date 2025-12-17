<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

abstract class Controller
{
    public function authorize(string $ability, string $modelClass): void
    {
        Gate::authorize($ability, $modelClass);
    }
}
