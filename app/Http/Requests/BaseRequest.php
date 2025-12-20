<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator): void
    {

        throw new HttpResponseException(
            response: response()->json([
                'mensagem' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST)
        );
    }

    abstract public function rules(): array;
}
