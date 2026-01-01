<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'min:10',
                'max:5000',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:999999999',
            ],
            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
                'dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000',
            ],
            'is_active' => [
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
            'title.required' => 'Judul tour harus diisi',
            'title.string' => 'Judul tour harus berupa teks',
            'title.min' => 'Judul tour minimal 3 karakter',
            'title.max' => 'Judul tour maksimal 255 karakter',
            'description.string' => 'Deskripsi harus berupa teks',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'description.max' => 'Deskripsi maksimal 5000 karakter',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'price.max' => 'Harga terlalu besar',
            'location.string' => 'Lokasi harus berupa teks',
            'location.max' => 'Lokasi maksimal 255 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus JPG atau PNG',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'image.dimensions' => 'Dimensi gambar harus antara 100x100 hingga 4000x4000 pixel',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Trim title and location
        $this->merge([
            'title' => trim($this->title ?? ''),
            'location' => trim($this->location ?? ''),
            'is_active' => $this->boolean('is_active', false),
        ]);
    }
}
