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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('cropName')->nullable();
            $table->integer('qte')->nullable();
            $table->string('unite')->nullable();
            $table->date('harvestDate')->nullable();
            $table->date('plantDate')->nullable();
            $table->string('health')->nullable();
            $table->string('amount')->nullable();
            $table->integer('dist_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
