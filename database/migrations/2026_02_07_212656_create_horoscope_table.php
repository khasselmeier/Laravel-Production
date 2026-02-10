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
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('sign_name');
            $table->string('core_vibe');
            $table->text('horoscope_text');
            $table->string('lucky_thing')->nullable();
            $table->string('unlucky_thing')->nullable();
            $table->unsignedTinyInteger('confidence_level')->nullable(); // 0–100, very fake
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscopes');
    }
};
