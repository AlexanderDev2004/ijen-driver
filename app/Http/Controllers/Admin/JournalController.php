<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index() {
        return response()->json(Journal::latest()->get());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tour_id' => 'required|exists:tours,id',
        ]);
        $journal = Journal::create($validated);
        return response()->json($journal, 201);
    }

    public function show($id) {
        return response()->json(Journal::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $journal = Journal::findOrFail($id);
        $journal->update($request->all());
        return response()->json($journal);
    }

    public function destroy($id) {
        Journal::findOrFail($id)->delete();
        return response()->json(['message' => 'Journal deleted']);
    }
}
