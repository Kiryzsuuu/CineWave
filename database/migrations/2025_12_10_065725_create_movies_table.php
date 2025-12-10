<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('backdrop')->nullable();
            $table->json('genre');
            $table->decimal('rating', 3, 1);
            $table->text('description');
            $table->integer('year');
            $table->string('duration')->nullable();
            $table->string('director')->nullable();
            $table->json('cast')->nullable();
            $table->string('category'); // trending, popular, newReleases, action, scifi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
