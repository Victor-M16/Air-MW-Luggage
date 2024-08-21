<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefinedSchema extends Migration
{
    public function up()
    {
        // Create customers table
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('firstname')->nullable(); // Add firstname column
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->timestamps();
        });

        // Create trips table
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('ticket_number')->unique(); // Ensure this is unique per trip
            $table->string('departure_point');
            $table->string('destination');
            $table->string('qr_code')->nullable(); // Path or URL to QR code image
            $table->timestamps();
        });

        // Create bags table
        Schema::create('bags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            $table->string('bag_description')->nullable();
            $table->timestamps();
        });

        // Create luggage_items table
        Schema::create('luggage_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bag_id')->constrained()->onDelete('cascade');
            $table->string('characteristic_1');
            $table->string('characteristic_2');
            $table->string('characteristic_3');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('luggage_items');
        Schema::dropIfExists('bags');
        Schema::dropIfExists('trips');
        Schema::dropIfExists('customers');
    }
}
