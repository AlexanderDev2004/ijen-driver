<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TourController extends Controller
{

    public function index()
    {
        $tours = Tour::orderByDesc('created_at')->get();
        return view('admin.tours.index', compact('tours'));
    }


    public function create()
    {
        return view('admin.tours.create');
    }


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


        $slug = Str::slug($validated['title']);
        $count = Tour::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $validated['slug'] = $slug;
        $validated['is_active'] = $request->has('is_active');

        Tour::create($validated);

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour berhasil ditambahkan!');
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean',
        ]);


        $slug = Str::slug($validated['title']);
        $count = Tour::where('slug', 'like', "{$slug}%")
                    ->where('id', '!=', $tour->id)
                    ->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $validated['slug'] = $slug;
        $validated['is_active'] = $request->has('is_active');

        // Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }
            $validated['image'] = $request->file('image')->store('tours', 'public');
        }

        $tour->update($validated);

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);

        if ($tour->image && Storage::disk('public')->exists($tour->image)) {
            Storage::disk('public')->delete($tour->image);
        }

        $tour->delete();

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour berhasil dihapus!');
    }
}
