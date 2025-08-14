<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourController extends Controller
{
    private $tourDetails = [
        'Kawah Ijen' => [
            'title' => 'Kawah Ijen Tour',
            'description' => 'Experience the mesmerizing blue fire phenomenon and the stunning turquoise crater lake of Kawah Ijen. Our tour includes a professional guide, safety equipment, and comfortable transportation to ensure a memorable and safe adventure.',
            'image' => 'images/kawah-ijen.png',
            'details' => [
                'Duration: 1 Day',
                'Difficulty: Moderate',
                'Highlights: Blue Fire, Crater Lake, Sulfur Miners',
            ]
        ],
        'Mount Bromo' => [
            'title' => 'Mount Bromo Tour',
            'description' => 'Witness the breathtaking sunrise over the magnificent Bromo volcano. This tour takes you through the "Sea of Sand" and up to the crater for an unforgettable view. Perfect for nature lovers and photographers.',
            'image' => 'images/bromo.png',
            'details' => [
                'Duration: 1 Days',
                'Difficulty: Easy',
                'location: the border between Banyuwangi Regency and Bondowoso Regency, East Java.',
                'Highlights: Sunrise View, Sea of Sand, Bromo Crater',
            ]
        ],
        'Tumpak Sewu' => [
            'title' => 'Tumpak Sewu Waterfall Tour',
            'description' => 'Discover the majestic Tumpak Sewu, often called the "Thousand Waterfalls." This tour offers a challenging trek through lush greenery to witness one of the most spectacular waterfalls in Indonesia. An adventure for the bold.',
            'image' => 'images/tumpak-sewu.png',
            'details' => [
                'Duration: 1 Day',
                'Difficulty: Hard',
                'Highlights: Panorama View, Trekking, Majestic Waterfall',
            ]
        ],
    ];

    public function show($name)
    {
        $tour = $this->tourDetails[$name] ?? null;

        if (!$tour) {
            abort(404);
        }

        return view('tour.show', compact('tour', 'name'));
    }
}
