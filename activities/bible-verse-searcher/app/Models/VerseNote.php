<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerseNote extends Model
{
    protected $table = 'verse_notes';
    protected $primaryKey = 'note_id';

    protected $fillable = ['verse_id', 'note_text'];

    public function verse()
    {
        return $this->belongsTo(BibleVerse::class, 'verse_id');
    }
}
