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
        Schema::create('bags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Foreign key column
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('bag_description')->nullable();
            $table->string('qr_code')->nullable(); // Path or URL to QR code image
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bags');
    }
};
