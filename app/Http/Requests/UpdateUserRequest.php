<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:40', 'unique:users,email,' . $this->user->id],
            'password' => ['nullable', Password::min(8)->letters()->numbers()],
            'phone' => ['nullable', 'string', 'max:40'],
            'level' => ['required', 'integer', 'in:' . User::LEVEL_USER . ',' . User::LEVEL_ADMIN],
            'blood_type' => ['nullable', 'string', 'max:3'],
            'status' => ['required', 'string', 'in:' . User::STATUS_INACTIVE . ',' . User::STATUS_ACTIVE],
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
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'level.required' => 'O nível de acesso é obrigatório.',
            'level.in' => 'O nível de acesso é inválido.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status é inválido.',
        ];
    }
}
