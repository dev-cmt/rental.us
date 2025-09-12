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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Chime, Venmo
            $table->string('logo')->nullable(); // URL or path to logo image
            $table->string('qr_code')->nullable(); // URL or path to QR code image
            $table->text('instructions')->nullable(); // optional description or instructions
            $table->boolean('status')->default(true); // active/inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
