<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJournalRequest;
use App\Models\Journal;
use App\Models\Tour;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::with('tour')->latest('journal_date')->paginate(12);
        return view('admin.journals.index', compact('journals'));
    }

    public function create()
    {
        $tours = Tour::orderBy('title')->get();
        return view('admin.journals.create', compact('tours'));
    }

    public function store(StoreJournalRequest $request)
    {
        try {
            $validated = $request->validated();

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('journals/photos', 'public');
            }

            // Handle video upload
            if ($request->hasFile('video')) {
                $validated['video'] = $request->file('video')->store('journals/videos', 'public');
            }

            Journal::create($validated);
            return redirect()->route('admin.journals.index')->with('success', 'Journal berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan journal: ' . $e->getMessage());
        }
    }

    public function edit(Journal $journal)
    {
        $tours = Tour::orderBy('title')->get();
        return view('admin.journals.edit', compact('journal', 'tours'));
    }

    public function update(StoreJournalRequest $request, Journal $journal)
    {
        try {
            $validated = $request->validated();

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($journal->photo && \Storage::disk('public')->exists($journal->photo)) {
                    \Storage::disk('public')->delete($journal->photo);
                }
                $validated['photo'] = $request->file('photo')->store('journals/photos', 'public');
            }

            // Handle video upload
            if ($request->hasFile('video')) {
                // Delete old video if exists
                if ($journal->video && \Storage::disk('public')->exists($journal->video)) {
                    \Storage::disk('public')->delete($journal->video);
                }
                $validated['video'] = $request->file('video')->store('journals/videos', 'public');
            }

            $journal->update($validated);
            return redirect()->route('admin.journals.index')->with('success', 'Journal berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui journal: ' . $e->getMessage());
        }
    }

    public function destroy(Journal $journal)
    {
        try {
            // Delete photo if exists
            if ($journal->photo && \Storage::disk('public')->exists($journal->photo)) {
                \Storage::disk('public')->delete($journal->photo);
            }

            // Delete video if exists
            if ($journal->video && \Storage::disk('public')->exists($journal->video)) {
                \Storage::disk('public')->delete($journal->video);
            }

            $journal->delete();
            return redirect()->route('admin.journals.index')->with('success', 'Journal berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus journal: ' . $e->getMessage());
        }
    }
}
