<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bible_verses', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('chapter');
            $table->integer('verse_num');
            $table->text('verse_text');
            $table->timestamps();

            $table->foreign('book_id')
                  ->references('book_id')
                  ->on('bible_books')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bible_verses');
    }
};
