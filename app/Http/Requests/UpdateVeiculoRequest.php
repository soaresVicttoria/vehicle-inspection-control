<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVeiculoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'proprietario_id' => 'sometimes|exist:proprietarios,id',
            'modelo' => 'sometimes|string|max:255',
            'placa' => 'sometimes|string|max:7|unique:veiculos,placa',
            'marca' => 'sometimes|string|max:255'
        ];
    }
}
