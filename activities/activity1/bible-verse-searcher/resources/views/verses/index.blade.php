@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h2 class="fw-bold">Bible Verses</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('verses.create') }}" class="btn btn-primary">➕ Add Verse</a>
    </div>
</div>

{{-- Search / Filter Form --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('verses.index') }}" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Search</label>
                <input type="text" name="q" class="form-control"
                       placeholder="Search verses..." value="{{ request('q') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Testament</label>
                <select name="testament" class="form-select">
                    <option value="">All</option>
                    <option value="OT" {{ request('testament') === 'OT' ? 'selected' : '' }}>Old Testament</option>
                    <option value="NT" {{ request('testament') === 'NT' ? 'selected' : '' }}>New Testament</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">🔍 Search</button>
                <a href="{{ route('verses.index') }}" class="btn btn-outline-secondary w-100">✕ Clear</a>
            </div>
        </form>
    </div>
</div>

<p class="text-muted small">Showing {{ $verses->total() }} verse(s)</p>

@forelse ($verses as $verse)
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">
                        {{ $verse->book->book_name ?? '—' }} {{ $verse->chapter }}:{{ $verse->verse_num }}
                        <span class="badge ms-1 {{ $verse->book->testament === 'OT' ? 'badge-ot' : 'badge-nt' }} text-white">
                            {{ $verse->book->testament ?? '' }}
                        </span>
                    </h5>
                    <p class="card-text text-muted mb-0">
                        "{{ Str::limit($verse->text, 120) }}"
                    </p>
                </div>
                <div class="d-flex gap-2 ms-3 flex-shrink-0">
                    <a href="{{ route('verses.show', $verse) }}" class="btn btn-sm btn-outline-primary">View</a>
                    <a href="{{ route('verses.edit', $verse) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <form method="POST" action="{{ route('verses.destroy', $verse) }}"
                          onsubmit="return confirm('Delete this verse and all its notes?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">No verses found. <a href="{{ route('verses.create') }}">Add one!</a></div>
@endforelse

<div class="mt-3">{{ $verses->withQueryString()->links() }}</div>
@endsection
