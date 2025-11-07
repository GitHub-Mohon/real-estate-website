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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->integer('admin_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('agent_id')->nullable();
            $table->string('name')->nullable();//guest
            $table->string('email')->unique()->nullable();//guest
            $table->string('website')->unique()->nullable();//guest
            $table->text('comment');
            $table->string('react_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
