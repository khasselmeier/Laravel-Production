<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // Dog, Cat, Rabbit, etc
            $table->integer('age');
            $table->text('bio')->nullable();
            $table->string('energy_level')->nullable(); // calm, chaotic, cuddly
            $table->string('zodiac_match')->nullable(); // links to horoscope wheel vibe
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
