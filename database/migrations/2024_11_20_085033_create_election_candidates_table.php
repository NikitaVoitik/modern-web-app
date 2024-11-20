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
        Schema::create('election_candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('election_id');
            $table->integer('candidate_id');
            $table->timestamps();

            $table->unique(['election_id', 'candidate_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_candidates');
    }
};
