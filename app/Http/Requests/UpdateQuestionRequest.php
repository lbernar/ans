<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'quest_id' => ['required', 'string', 'max:255', 'unique:questions,quest_id,' . $this->question->id],
            'question' => ['required', 'string'],
            'type' => ['nullable', 'string', 'max:1'],
            'bu' => ['nullable', 'string', 'max:40'],
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
            'quest_id.required' => 'O ID da questão é obrigatório.',
            'quest_id.unique' => 'Este ID de questão já está cadastrado.',
            'question.required' => 'A questão é obrigatória.',
        ];
    }
}
