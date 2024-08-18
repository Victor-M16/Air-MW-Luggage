<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('ticket_number')->unique(); // Ensure this is unique per trip
            $table->string('qr_code')->nullable(); // Path or URL to QR code image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
