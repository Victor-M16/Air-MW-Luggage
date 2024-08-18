<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('luggage_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bag_id')->constrained()->onDelete('cascade');
            $table->string('characteristic_1');
            $table->string('characteristic_2');
            $table->string('characteristic_3');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luggage_items');
    }
};
