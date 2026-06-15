<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verse_notes', function (Blueprint $table) {
            $table->id('note_id');
            $table->unsignedBigInteger('verse_id');
            $table->text('note_text');
            $table->timestamps();

            $table->foreign('verse_id')
                  ->references('id')
                  ->on('bible_verses')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verse_notes');
    }
};
