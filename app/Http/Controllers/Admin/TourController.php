<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::latest()->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'location' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'is_active' => 'nullable|boolean',
            ]);

            // ✅ Generate slug unik
            $slug = Str::slug($validated['title']);
            $baseSlug = $slug;
            $count = 1;
            while (Tour::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;

            // ✅ Upload image jika ada
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('tours', 'public');
            }

            // ✅ Default aktif
            $validated['is_active'] = $request->boolean('is_active', true);

            // ✅ Simpan ke database
            Tour::create($validated);

            return redirect()->route('admin.tours.index')
                ->with('success', 'Tour berhasil ditambahkan!');
        } catch (Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal menyimpan Tour: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(Request $request, Tour $tour)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        // ✅ Slug unik
        $slug = Str::slug($validated['title']);
        $baseSlug = $slug;
        $count = 1;
        while (Tour::where('slug', $slug)->where('id', '!=', $tour->id)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }
        $validated['slug'] = $slug;
        $validated['is_active'] = $request->boolean('is_active', true);

        // ✅ Ganti image jika diupload
        if ($request->hasFile('image')) {
            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }
            $validated['image'] = $request->file('image')->store('tours', 'public');
        }

        $tour->update($validated);

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour berhasil diperbarui!');
    }

    public function destroy(Tour $tour)
    {
        if ($tour->image && Storage::disk('public')->exists($tour->image)) {
            Storage::disk('public')->delete($tour->image);
        }

        $tour->delete();

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour berhasil dihapus!');
    }
}
