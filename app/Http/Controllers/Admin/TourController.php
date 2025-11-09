<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    // List semua tour
    public function index() {
        return response()->json(Tour::all());
    }

    // Simpan Tour baru
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
        $tour = Tour::create($validated);
        return response()->json($tour, 201);
    }

    // Tampilkan detail
    public function show($id) {
        return response()->json(Tour::findOrFail($id));
    }

    // Update Tour
    public function update(Request $request, $id) {
        $tour = Tour::findOrFail($id);
        $tour->update($request->all());
        return response()->json($tour);
    }

    // Hapus Tour
    public function destroy($id) {
        Tour::findOrFail($id)->delete();
        return response()->json(['message' => 'Tour deleted']);
    }
}
