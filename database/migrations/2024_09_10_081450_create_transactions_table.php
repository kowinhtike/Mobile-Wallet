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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('note')->nullable();
            $table->integer('amount');
            $table->boolean('read')->default(false);
            $table->unsignedBigInteger('profile1_id');
            $table->unsignedBigInteger('profile2_id');
            $table->timestamps();
            $table->foreign('profile1_id')->references('id')->on("profiles")->onDelete('cascade');
            $table->foreign('profile2_id')->references('id')->on("profiles")->onDelete('cascade');
            // Adding index for performance optimization
            $table->index('profile1_id');
            $table->index('profile2_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
