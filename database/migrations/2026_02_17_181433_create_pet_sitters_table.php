<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_sitters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('experience');
            $table->string('availability')->nullable();
            $table->string('preferred_animals')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_sitters');
    }
};
