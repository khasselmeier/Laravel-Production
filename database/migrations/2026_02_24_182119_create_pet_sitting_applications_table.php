<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pet_sitting_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->text('experience');
            $table->string('availability')->nullable();
            $table->string('preferred_animals')->nullable();

            $table->string('status')->default('pending'); // pending|approved|flagged
            $table->text('moderation_notes')->nullable();
            $table->timestamp('moderated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_sitting_applications');
    }
};
