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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 192)->default('text');
            $table->text('description')->nullable()->default('text');
            $table->unsignedBigInteger('creator');
            $table->integer('price')->nullable()->default(12);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('creator')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
