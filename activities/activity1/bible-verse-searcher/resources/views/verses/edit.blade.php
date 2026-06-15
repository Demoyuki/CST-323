@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header fw-bold fs-5">✏️ Edit Verse</div>
            <div class="card-body">
                <form method="POST" action="{{ route('verses.update', $verse) }}">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Book <span class="text-danger">*</span></label>
                        <select name="book_id" class="form-select @error('book_id') is-invalid @enderror">
                            <option value="">— Select a book —</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->book_id }}"
                                    {{ old('book_id', $verse->book_id) == $book->book_id ? 'selected' : '' }}>
                                    {{ $book->book_name }} ({{ $book->testament }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Chapter <span class="text-danger">*</span></label>
                            <input type="number" name="chapter" min="1"
                                   class="form-control @error('chapter') is-invalid @enderror"
                                   value="{{ old('chapter', $verse->chapter) }}">
                            @error('chapter') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Verse # <span class="text-danger">*</span></label>
                            <input type="number" name="verse_num" min="1"
                                   class="form-control @error('verse_num') is-invalid @enderror"
                                   value="{{ old('verse_num', $verse->verse_num) }}">
                            @error('verse_num') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Verse Text <span class="text-danger">*</span></label>
                        <textarea name="text" rows="4"
                                  class="form-control @error('text') is-invalid @enderror">{{ old('text', $verse->text) }}</textarea>
                        @error('text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('verses.show', $verse) }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
