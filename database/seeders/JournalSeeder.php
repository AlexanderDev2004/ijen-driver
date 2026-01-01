<?php

namespace Database\Seeders;

use App\Models\Journal;
use App\Models\Tour;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run()
    {
        $tours = Tour::all();

        if ($tours->isEmpty()) {
            return;
        }

        $journals = [
            [
                'tour_id' => $tours->first()->id,
                'title' => 'Pendakian Pagi Menuju Puncak Ijen',
                'content' => 'Hari pertama pendakian dimulai pukul 04:00 pagi dari basecamp. Cuaca cukup cerah dan suasana masih tenang. Para pendaki mulai berkumpul dan mempersiapkan perlengkapan mereka. Pemandu wisata memberikan briefing singkat tentang rute dan keselamatan. Setelah semua siap, kami berangkat menuju puncak dengan semangat tinggi.',
                'journal_date' => now()->subDays(5),
            ],
            [
                'tour_id' => $tours->first()->id,
                'title' => 'Fenomena Api Biru di Kawah Ijen',
                'content' => 'Tiba di puncak Ijen sekitar pukul 07:00 pagi. Pemandangan kawah dan fenomena api biru sangat spektakuler pada saat fajar. Sulfur yang terbakar menghasilkan api berwarna biru yang menakjubkan. Kami mengambil banyak foto dan video untuk mengabadikan momen langka ini. Rasanya sangat berharga bisa melihat keajaiban alam yang jarang ditemukan di tempat lain.',
                'journal_date' => now()->subDays(4),
            ],
            [
                'tour_id' => $tours->last()->id,
                'title' => 'Petualangan Mengenal Budaya Lokal',
                'content' => 'Setelah mendaki, kami kembali ke desa untuk berinteraksi dengan penduduk lokal. Mereka sangat ramah dan senang berbagi cerita tentang kehidupan mereka. Kami mencoba makanan tradisional yang lezat dan belajar tentang tradisi setempat. Pengalaman ini memberikan perspektif baru tentang kehidupan sederhana namun bermakna.',
                'journal_date' => now()->subDays(3),
            ],
        ];

        foreach ($journals as $journal) {
            Journal::create($journal);
        }
    }
}
