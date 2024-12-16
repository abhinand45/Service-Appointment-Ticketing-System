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
        Schema::create('service-tickets', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('service_type');
            $table->dateTime('appointment_datetime');
            $table->string('contact_number');
            $table->text('description')->nullable();
            $table->string('ticket_number')->unique();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_ticket');
    }
};
