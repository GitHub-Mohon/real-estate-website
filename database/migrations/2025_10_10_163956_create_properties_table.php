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
            $table->integer('agent_id');
            $table->integer('location_id');
            $table->integer('type_id');
            $table->string('amenities')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('featured_photo');
            $table->string('purpose');
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('size')->nullable();
            $table->string('floor')->nullable();
            $table->string('balcony')->nullable();
            $table->string('garage')->nullable();
            $table->string('address')->nullable();
            $table->integer('built_year')->nullable();
            $table->text('map')->nullable();
            $table->string('is_featured');
            $table->string('status');
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
