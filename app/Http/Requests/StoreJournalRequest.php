<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJournalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tour_id' => ['required', 'exists:tours,id'],
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
            'journal_date' => ['required', 'date'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'], // max 5MB
            'video' => ['nullable', 'file', 'mimes:mp4,avi,mov,wmv,flv', 'max:51200'], // max 50MB
        ];
    }

    public function messages()
    {
        return [
            'tour_id.required' => 'Tour harus dipilih',
            'tour_id.exists' => 'Tour yang dipilih tidak valid',
            'title.required' => 'Judul journal wajib diisi',
            'title.min' => 'Judul journal minimal 5 karakter',
            'title.max' => 'Judul journal maksimal 255 karakter',
            'content.required' => 'Konten journal wajib diisi',
            'content.min' => 'Konten journal minimal 10 karakter',
            'journal_date.required' => 'Tanggal journal wajib diisi',
            'journal_date.date' => 'Format tanggal tidak valid',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format foto harus jpeg, jpg, png, atau webp',
            'photo.max' => 'Ukuran foto maksimal 5MB',
            'video.file' => 'File harus berupa video',
            'video.mimes' => 'Format video harus mp4, avi, mov, wmv, atau flv',
            'video.max' => 'Ukuran video maksimal 50MB',
        ];
    }
}
