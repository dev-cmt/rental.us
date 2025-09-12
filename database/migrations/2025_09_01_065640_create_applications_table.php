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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Personal and contact information
            $table->date('move_in_date')->nullable();
            $table->enum('application_type', ['tenant', 'guarantor']);
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();

            // Address details
            $table->text('current_address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('country', 100)->nullable();

            // Citizenship and identity
            $table->enum('citizenship', ['yes', 'no']);
            $table->date('date_of_birth')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->string('government_id')->nullable();
            $table->string('issuing_state', 100)->nullable();
            $table->string('ssn')->nullable();

            // Document paths
            $table->string('id_front_path')->nullable();
            $table->string('id_back_path')->nullable();
            $table->string('selfie_path')->nullable();
            $table->string('income_path')->nullable();
            $table->string('payment_path')->nullable();

            // Status and timestamps
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
