<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVeiculoRequest extends FormRequest
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
            'proprietario_id' => 'required|exists:proprietarios,id',
            'modelo' => 'required|string|max:255',
            'placa' => 'required|string|max:7|unique:veiculos,placa',
            'marca' => 'required|string|max:255'
        ];
    }
}
