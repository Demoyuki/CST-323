<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BibleVerse extends Model
{
    protected $table = 'bible_verses';
    public $timestamps = false; //

    protected $fillable = ['book_id', 'chapter', 'verse_num', 'text'];

    public function book()
    {
        return $this->belongsTo(BibleBook::class, 'book_id', 'book_id');
    }

    public function notes()
    {
        return $this->hasMany(VerseNote::class, 'verse_id');
    }
}