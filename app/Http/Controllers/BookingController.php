<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
     public function form(Request $request, $tour = null)
    {
        $draft = session('booking_draft', []);

        // Pass both draft data and the tour name to the view
        return view('booking.form', [
            'draft' => $draft,
            'tour_name' => $tour
        ]);
    }

    public function preview(Request $request)
    {
        $rules = [
            'tour_name'     => ['nullable', 'string', 'max:100'], // Add validation for the tour name
            'nama'          => ['required', 'string', 'max:100'],
            'email'         => ['required', 'email', 'max:150'],
            'telpon'        => ['required', 'string', 'max:20'],
            'jumlah'        => ['required', 'integer', 'min:1', 'max:30'],
            'tanggal'       => ['required', 'date', 'after_or_equal:today'],
            'bawa_anak'     => ['nullable', 'boolean'],
        ];

        $messages = [
            'nama.required'          => 'Name must be filled in.',
            'email.email'            => 'Email format is not valid.',
            'telpon.required'        => 'Phone number is required.',
            'jumlah.min'             => 'Minimum 1 person.',
            'tanggal.after_or_equal' => 'Date cannot be in the past.',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('booking.form', ['tour' => $request->tour_name]) // Pass the tour name back to the form
                ->withErrors($validator)
                ->withInput();
        }

        $clean = [
            'tour_name' => $request->string('tour_name') ?? '',
            'nama'      => $request->string('nama'),
            'email'     => $request->string('email'),
            'telpon'    => $request->string('telpon'),
            'jumlah'    => (int) $request->input('jumlah'),
            'tanggal'   => $request->date('tanggal')->format('Y-m-d'),
            'bawa_anak' => (bool) $request->boolean('bawa_anak'),
            // 'catatan'   => $request->string('catatan') ?? '',
        ];

        session(['booking_draft' => $clean]);
        return view('booking.preview', ['data' => $clean]);
    }

    public function send(Request $request)
    {
        $data = session('booking_draft');
        if (!$data) {
            return redirect()->route('booking.form')->with('error', 'Data pemesanan tidak ditemukan. Silakan isi form.');
        }

        $admin = config('app.whatsapp_admin', env('WHATSAPP_ADMIN'));
        if (!$admin) {
            return redirect()->route('booking.form')->with('error', 'Nomor WhatsApp admin belum disetel.');
        }

        $title = config('app.name', 'Ijen Driver');
        $lines = [
            "Hello Admin {$title}, I would like to book a tour:",
            "Tour: " . ($data['tour_name'] ?? 'Not specified'), // Add the tour name to the message
            "Name: {$data['nama']}",
            "Email: {$data['email']}",
            "Phone: {$data['telpon']}",
            "Number of People: {$data['jumlah']}",
            "Date: {$data['tanggal']}",
            "Bringing Children: " . ($data['bawa_anak'] ? 'Yes' : 'No'),
        ];
        // if (!empty($data['catatan'])) {
        //     $lines[] = "Catatan: {$data['catatan']}";
        // }
        // $lines[] = "";
        $lines[] = "Please provide availability and price information. Thank you.";

        $text = implode("\n", $lines);
        $waUrl = 'https://wa.me/' . $admin . '?text=' . urlencode($text);

        session()->forget('booking_draft');

        return redirect()->away($waUrl);
    }
}
