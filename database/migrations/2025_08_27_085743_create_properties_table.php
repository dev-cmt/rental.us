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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('area_size')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->integer('bed_room')->default(0);
            $table->integer('dining_room')->default(0);
            $table->integer('bath_room')->default(0);
            $table->integer('balcony')->default(0);
            $table->enum('property_status', ['For Sale', 'For Rent', 'Sold', 'Under Offer'])->default('For Sale');
            $table->enum('condition', ['New', 'Resale', 'Under Construction'])->default('New');
            $table->integer('built_year')->nullable();
            $table->string('dimension')->nullable();
            $table->text('location')->nullable(); // Google map URL
            $table->text('address')->nullable();
            $table->string('state_county')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('view_count')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
