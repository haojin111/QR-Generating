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
        Schema::create('qr_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1024);
            $table->string('resource', 1024)->unique(); 
            $table->enum('type', ['Dynamic', 'Resource', 'Remote']);
            $table->boolean('is_locked');
            $table->enum('owner', ['User', 'Pincode', 'Email']);
            $table->bigInteger('access_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_requests');
    }
};
