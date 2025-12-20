<?php

declare(strict_types=1);

namespace App\Http\Requests\App;

use App\Http\Requests\BaseRequest;
use App\Models\Pet\Pet;
use App\Models\Pet\Specie;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'address' => ['required', 'array'],
            'address.street' => ['required', 'string'],
            'address.number' => ['nullable', 'string'],
            'address.complement' => ['nullable', 'string'],
            'address.neighborhood' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.zip_code' => ['required', 'string'],
            'pets' => ['required', 'array'],
            'pets.*.name' => ['required', 'string'],
            'pets.*.specie_id' => ['required', Rule::exists(Specie::class, 'id')],
            'pets.*.birth_date' => ['nullable', 'date'],
            'pets.*.color' => ['nullable', 'string'],
            'pets.*.size' => ['nullable', 'string', Rule::in([Pet::SMALL, Pet::MEDIUM, Pet::LARGE])],
            'pets.*.microchipped' => ['nullable', 'boolean'],
            'pets.*.microchip_number' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'address' => 'endereço',
            'address.street' => 'rua',
            'address.number' => 'número',
            'address.complement' => 'complemento',
            'address.neighborhood' => 'bairro',
            'address.city' => 'cidade',
            'address.state' => 'estado',
            'address.country' => 'país',
            'address.zip_code' => 'cep',
            // pets
            'pets' => 'pets',
            'pets.*.name' => 'nome do pet',
            'pets.*.specie_id' => 'espécie',
            'pets.*.birth_date' => 'data de nascimento',
            'pets.*.color' => 'cor',
            'pets.*.size' => 'tamanho',
            'pets.*.microchipped' => 'microchipado',
            'pets.*.microchip_number' => 'número do microchip',
        ];
    }
}
