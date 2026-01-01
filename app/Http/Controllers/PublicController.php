<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;

class PublicController extends Controller
{
    public function index()
    {
        $tours = Tour::where('is_active', true)
            ->latest('created_at')
            ->paginate(12);
        return view('public.index', compact('tours'));
    }

    public function showTour(Tour $tour)
    {
        // Eager load journals untuk optimasi
        $tour->load('journals');

        return view('public.tour', compact('tour'));
    }

    public function bookingForm(Tour $tour)
    {
        return view('public.booking', compact('tour'));
    }

    public function submitBooking(StoreBookingRequest $request, Tour $tour)
    {
        $data = $request->validated();
        // Convert has_children to boolean
        $data['has_children'] = $data['has_children'] === 'on';
        if (!$data['has_children']) $data['children_count'] = null;

        $booking = Booking::create(array_merge($data, [
            'tour_id' => $tour->id,
            'status' => 'pending',
        ]));

        // show confirmation page (user can review)
        return redirect()->route('booking.confirm', $booking->id);
    }

    public function bookingConfirm($id)
    {
        $booking = Booking::with('tour.journals')->findOrFail($id);
        return view('public.confirm', compact('booking'));
    }

    // when user clicks "Send to WhatsApp" to finalize
    public function sendToWhatsApp($id)
    {
        $b = Booking::with('tour')->findOrFail($id);

        // prepare message
        $msg = "Booking IjenDriver\n" .
            "Tour: {$b->tour->title}\n" .
            "Nama: {$b->name}\n" .
            "Tanggal: {$b->date->format('Y-m-d')}\n" .
            "Orang: {$b->people}\n" .
            "Ada Anak: " . ($b->has_children ? "Ya ({$b->children_count})" : "Tidak") . "\n" .
            "Catatan: " . ($b->notes ?? '-') . "\n" .
            "ID Booking: {$b->id}";

        // update status
        $b->update(['status' => 'sent_to_wa']);

        // URL encode message and redirect to whatsapp link
        $encoded = urlencode($msg);
        $ownerNumber = env('WA_OWNER_NUMBER', '6281234567890'); // default number jika tidak ada di .env
        $waLink = "https://wa.me/{$ownerNumber}?text={$encoded}";

        return redirect()->away($waLink);
    }
}
