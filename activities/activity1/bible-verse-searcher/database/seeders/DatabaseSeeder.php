<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Bible books
        $books = [
            ['book_id' => 1,  'book_name' => 'Genesis',       'testament' => 'OT', 'chapter_count' => 50],
            ['book_id' => 19, 'book_name' => 'Psalms',        'testament' => 'OT', 'chapter_count' => 150],
            ['book_id' => 20, 'book_name' => 'Proverbs',      'testament' => 'OT', 'chapter_count' => 31],
            ['book_id' => 23, 'book_name' => 'Isaiah',        'testament' => 'OT', 'chapter_count' => 66],
            ['book_id' => 40, 'book_name' => 'Matthew',       'testament' => 'NT', 'chapter_count' => 28],
            ['book_id' => 43, 'book_name' => 'John',          'testament' => 'NT', 'chapter_count' => 21],
            ['book_id' => 45, 'book_name' => 'Romans',        'testament' => 'NT', 'chapter_count' => 16],
            ['book_id' => 49, 'book_name' => 'Ephesians',     'testament' => 'NT', 'chapter_count' => 6],
            ['book_id' => 50, 'book_name' => 'Philippians',   'testament' => 'NT', 'chapter_count' => 4],
        ];

        DB::table('bible_books')->insertOrIgnore($books);

        // Sample verses
        $verses = [
            ['book_id' => 43, 'chapter' => 3,  'verse_num' => 16, 'verse_text' => 'For God so loved the world that he gave his one and only Son, that whoever believes in him shall not perish but have eternal life.'],
            ['book_id' => 19, 'chapter' => 23, 'verse_num' => 1,  'verse_text' => 'The LORD is my shepherd, I lack nothing.'],
            ['book_id' => 50, 'chapter' => 4,  'verse_num' => 13, 'verse_text' => 'I can do all this through him who gives me strength.'],
            ['book_id' => 23, 'chapter' => 40, 'verse_num' => 31, 'verse_text' => 'But those who hope in the LORD will renew their strength. They will soar on wings like eagles; they will run and not grow weary, they will walk and not be faint.'],
            ['book_id' => 20, 'chapter' => 3,  'verse_num' => 5,  'verse_text' => 'Trust in the LORD with all your heart and lean not on your own understanding; in all your ways submit to him, and he will make your paths straight.'],
            ['book_id' => 49, 'chapter' => 2,  'verse_num' => 8,  'verse_text' => 'For it is by grace you have been saved, through faith—and this is not from yourselves, it is the gift of God.'],
            ['book_id' => 45, 'chapter' => 8,  'verse_num' => 28, 'verse_text' => 'And we know that in all things God works for the good of those who love him, who have been called according to his purpose.'],
            ['book_id' => 1,  'chapter' => 1,  'verse_num' => 1,  'verse_text' => 'In the beginning God created the heavens and the earth.'],
        ];

        DB::table('bible_verses')->insertOrIgnore($verses);
    }
}
