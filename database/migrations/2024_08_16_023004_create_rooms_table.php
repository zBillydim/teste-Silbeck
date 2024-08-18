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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hotel');
            $table->string('room_number');
            $table->string('description');
            $table->enum('status', ['available', 'occupied', 'maintenance']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('hotels')->onDelete('cascade');
        });
        
        Schema::create('room_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_room');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_hotel');
            $table->date('checkin');
            $table->date('checkout')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'canceled']);
            $table->float('total_price')->nullable();
            $table->float('unit_price');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_room')->references('id')->on('rooms')->onDelete('no action');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('no action');
            $table->foreign('id_hotel')->references('id')->on('hotels')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_reservations');
    }
};
