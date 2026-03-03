<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sitter_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->text('experience')->nullable();

            $table->json('allowed_species')->default(json_encode([]));
            $table->json('vibes')->default(json_encode([]));
            $table->json('cannot_handle')->default(json_encode([]));

            $table->string('status')->default('pending'); // pending|approved|flagged
            $table->text('moderation_notes')->nullable();
            $table->timestamp('moderated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sitter_profiles');
    }
};
