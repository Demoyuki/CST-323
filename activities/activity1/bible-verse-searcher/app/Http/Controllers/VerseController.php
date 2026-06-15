<?php

namespace App\Http\Controllers;

use App\Models\BibleBook;
use App\Models\BibleVerse;
use App\Models\VerseNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerseController extends Controller
{
    // READ ALL — list with optional search
    public function index(Request $request)
    {
        Log::info('VerseController@index called', ['query' => $request->input('q'), 'testament' => $request->input('testament')]);

        $query = BibleVerse::with('book');

        if ($request->filled('q')) {
            $query->where('text', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('testament')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('testament', $request->testament);
            });
        }

        $verses = $query->orderBy('book_id')->orderBy('chapter')->orderBy('verse_num')->paginate(20);
        $books  = BibleBook::orderBy('book_id')->get();

        return view('verses.index', compact('verses', 'books'));
    }

    // READ ONE
    public function show(BibleVerse $verse)
    {
        Log::info('VerseController@show called', ['verse_id' => $verse->id]);
        $verse->load('book', 'notes');
        return view('verses.show', compact('verse'));
    }

    // CREATE — form
    public function create()
    {
        $books = BibleBook::orderBy('book_id')->get();
        return view('verses.create', compact('books'));
    }

    // CREATE — store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id'    => 'required|integer|exists:bible_books,book_id',
            'chapter'    => 'required|integer|min:1',
            'verse_num'  => 'required|integer|min:1',
            'text' => 'required|string|max:800',
        ]);

        $verse = BibleVerse::create($validated);
        Log::info('VerseController@store — verse created', ['verse_id' => $verse->id]);

        return redirect()->route('verses.show', $verse)->with('success', 'Verse added successfully.');
    }

    // UPDATE — form
    public function edit(BibleVerse $verse)
    {
        $books = BibleBook::orderBy('book_id')->get();
        return view('verses.edit', compact('verse', 'books'));
    }

    // UPDATE — save
    public function update(Request $request, BibleVerse $verse)
    {
        $validated = $request->validate([
            'book_id'    => 'required|integer|exists:bible_books,book_id',
            'chapter'    => 'required|integer|min:1',
            'verse_num'  => 'required|integer|min:1',
            'text' => 'required|string|max:800',
        ]);

        $verse->update($validated);
        Log::info('VerseController@update — verse updated', ['verse_id' => $verse->id]);

        return redirect()->route('verses.show', $verse)->with('success', 'Verse updated successfully.');
    }

    // DELETE
    public function destroy(BibleVerse $verse)
    {
        Log::info('VerseController@destroy — verse deleted', ['verse_id' => $verse->id]);
        $verse->delete();
        return redirect()->route('verses.index')->with('success', 'Verse deleted.');
    }

    // NOTES — store a new note on a verse
    public function storeNote(Request $request, BibleVerse $verse)
    {
        $validated = $request->validate([
            'note_text' => 'required|string|max:800',
        ]);

        $note = $verse->notes()->create($validated);
        Log::info('VerseController@storeNote — note created', ['note_id' => $note->note_id, 'verse_id' => $verse->id]);

        return redirect()->route('verses.show', $verse)->with('success', 'Note saved.');
    }

    // NOTES — delete a note
    public function destroyNote(BibleVerse $verse, VerseNote $note)
    {
        Log::info('VerseController@destroyNote — note deleted', ['note_id' => $note->note_id]);
        $note->delete();
        return redirect()->route('verses.show', $verse)->with('success', 'Note deleted.');
    }
}
