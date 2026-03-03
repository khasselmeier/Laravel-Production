<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pet_sitting_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('pet_name');
            $table->string('species');

            $table->json('pet_traits')->default(json_encode([]));

            $table->date('start_date');
            $table->date('end_date');

            $table->text('notes')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_sitting_requests');
    }
};
