<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Grid::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->json('attempt');
            $table->integer('time')->default(0); // in seconds
            $table->boolean('is_finished')->default(false);
            $table->boolean('is_solved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_attempts');
    }
};
