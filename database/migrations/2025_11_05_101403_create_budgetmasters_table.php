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
        Schema::create('budgetmasters', function (Blueprint $table) {
            $table->id();
            $table->decimal('budget', 15,0);
            $table->year('tahun_anggaran')->unique();
            $table->text('detail');
            $table->unsignedBigInteger('user_id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgetmasters');
    }
};
