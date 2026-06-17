<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BibleBook extends Model
{
    protected $table = 'bible_books';
    protected $primaryKey = 'book_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['book_id', 'book_name', 'testament', 'chapter_count'];

    public function verses()
    {
        return $this->hasMany(BibleVerse::class, 'book_id', 'book_id');
    }
}
