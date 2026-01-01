<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:191',
                'regex:/^[a-zA-Z0-9\s\-\.\'áéíóúàèìòùäëïöüâêîôûãõñ]+$/i',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
                'regex:/^[0-9+\-\s()]*$/',
            ],
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'people' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],
            'has_children' => [
                'sometimes',
                'in:on',
            ],
            'children_count' => [
                'nullable',
                'integer',
                'min:1',
                'max:100',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:1000',
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
            'name.regex' => 'Nama hanya boleh mengandung huruf, angka, dan karakter tertentu',
            'phone.string' => 'Nomor HP harus berupa teks',
            'phone.max' => 'Nomor HP maksimal 30 karakter',
            'phone.regex' => 'Format nomor HP tidak valid',
            'date.required' => 'Tanggal harus dipilih',
            'date.date' => 'Format tanggal tidak valid',
            'date.after_or_equal' => 'Tanggal tidak boleh di masa lalu',
            'people.required' => 'Jumlah orang harus diisi',
            'people.integer' => 'Jumlah orang harus berupa angka',
            'people.min' => 'Jumlah orang minimal 1',
            'people.max' => 'Jumlah orang maksimal 100',
            'children_count.integer' => 'Jumlah anak harus berupa angka',
            'children_count.min' => 'Jumlah anak minimal 1',
            'children_count.max' => 'Jumlah anak maksimal 100',
            'notes.string' => 'Catatan harus berupa teks',
            'notes.max' => 'Catatan maksimal 1000 karakter',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean up phone number
        if ($this->phone) {
            $this->merge([
                'phone' => preg_replace('/[^0-9+\-\s()]/i', '', $this->phone),
            ]);
        }

        // Ensure children_count is null if has_children is not checked
        if (!$this->has('has_children') || $this->has_children !== 'on') {
            $this->merge([
                'children_count' => null,
            ]);
        }
    }
}
