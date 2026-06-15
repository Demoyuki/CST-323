@extends('layouts.app')

@section('content')
<div class="mb-3">
    <a href="{{ route('verses.index') }}" class="text-decoration-none">← Back to Verses</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h3 class="fw-bold">
                    ✝ {{ $verse->book->book_name }} {{ $verse->chapter }}:{{ $verse->verse_num }}
                    <span class="badge ms-2 {{ $verse->book->testament === 'OT' ? 'badge-ot' : 'badge-nt' }} text-white">
                        {{ $verse->book->testament }}
                    </span>
                </h3>
                <p class="fs-5 fst-italic text-muted mt-2">"{{ $verse->text }}"</p>
            </div>
            <div class="d-flex gap-2 ms-3 flex-shrink-0">
                <a href="{{ route('verses.edit', $verse) }}" class="btn btn-outline-secondary">✏️ Edit</a>
                <form method="POST" action="{{ route('verses.destroy', $verse) }}"
                      onsubmit="return confirm('Delete this verse and all its notes?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger">🗑 Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Notes Section --}}
<h4 class="fw-bold mb-3">📝 Personal Notes ({{ $verse->notes->count() }})</h4>

@forelse ($verse->notes as $note)
    <div class="card mb-2">
        <div class="card-body d-flex justify-content-between align-items-start">
            <div>
                <p class="mb-1">{{ $note->note_text }}</p>
                <small class="text-muted">{{ $note->created_at->format('M d, Y') }}</small>
            </div>
            <form method="POST" action="{{ route('verses.notes.destroy', [$verse, $note]) }}"
                  onsubmit="return confirm('Delete this note?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger ms-3">Delete</button>
            </form>
        </div>
    </div>
@empty
    <p class="text-muted">No notes yet.</p>
@endforelse

{{-- Add Note Form --}}
<div class="card mt-4">
    <div class="card-header fw-semibold">Add a Note</div>
    <div class="card-body">
        <form method="POST" action="{{ route('verses.notes.store', $verse) }}">
            @csrf
            <div class="mb-3">
                <textarea name="note_text" class="form-control @error('note_text') is-invalid @enderror"
                          rows="3" placeholder="Write your personal reflection...">{{ old('note_text') }}</textarea>
                @error('note_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">💾 Save Note</button>
        </form>
    </div>
</div>
@endsection
