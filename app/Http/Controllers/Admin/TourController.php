<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{

    public function index()
    {
        $tours = Tour::orderBy('created_at', 'desc')->get();
        return view('admin.tours.index', compact('tours'));
    }


    public function create()
    {
        return view('admin.tours.create');
    }

    /**
     * Simpan tour baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean',
        ]);


        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('tours', 'public');
        }


        $validated['is_active'] = $request->has('is_active');

        Tour::create($validated);

        return redirect()->route('admin.tours.index')->with('success', 'Tour berhasil ditambahkan!');
    }


    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('admin.tours.show', compact('tour'));
    }


    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        return view('admin.tours.edit', compact('tour'));
    }


    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean',
        ]);


        if ($request->hasFile('image')) {
            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }
            $validated['image'] = $request->file('image')->store('tours', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $tour->update($validated);

        return redirect()->route('admin.tours.index')->with('success', 'Tour berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);

        if ($tour->image && Storage::disk('public')->exists($tour->image)) {
            Storage::disk('public')->delete($tour->image);
        }

        $tour->delete();

        return redirect()->route('admin.tours.index')->with('success', 'Tour berhasil dihapus!');
    }
}
