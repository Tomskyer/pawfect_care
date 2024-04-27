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
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_id");
            $table->string('name');
            $table->string('gender');
            $table->string('breed');
            $table->date('birthdate');
            $table->float('size');
            $table->string('neutered');
            $table->string('about')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dogs');
    }
};
