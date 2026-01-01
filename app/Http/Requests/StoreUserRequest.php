<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:191',
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:191',
                'alpha_num',
                Rule::unique('m_user', 'username')->ignore($userId),
            ],
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('m_user', 'email')->ignore($userId),
            ],
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'string',
                'min:6',
                'max:191',
            ],
            'password_confirmation' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'string',
                'same:password',
            ],
            'is_admin' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa teks',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 191 karakter',
            'username.required' => 'Username harus diisi',
            'username.string' => 'Username harus berupa teks',
            'username.min' => 'Username minimal 3 karakter',
            'username.max' => 'Username maksimal 191 karakter',
            'username.alpha_num' => 'Username hanya boleh mengandung huruf dan angka',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 191 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa teks',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 191 karakter',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'password_confirmation.same' => 'Password dan konfirmasi tidak cocok',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => trim($this->username ?? ''),
            'email' => trim($this->email ?? ''),
            'is_admin' => $this->boolean('is_admin', false),
        ]);
    }
}
