<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bags', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_id'); // Add trip_id to reference trips
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');

            $table->dropForeign(['customer_id']); // Drop the existing foreign key if it exists
            $table->dropColumn('customer_id'); // Remove the customer_id column
        });
    }

    public function down(): void
    {
        Schema::table('bags', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('ticket_number');

            $table->dropForeign(['trip_id']);
            $table->dropColumn('trip_id');
        });
    }
};


