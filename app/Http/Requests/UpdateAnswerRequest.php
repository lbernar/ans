<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'resp_id' => ['required', 'string', 'max:255'],
            'quest_id' => ['required', 'string', 'max:255', 'exists:questions,quest_id'],
            'response' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'resp_id.required' => 'O ID da resposta é obrigatório.',
            'quest_id.required' => 'O ID da questão é obrigatório.',
            'quest_id.exists' => 'A questão selecionada não existe.',
            'response.required' => 'A resposta é obrigatória.',
        ];
    }
}
