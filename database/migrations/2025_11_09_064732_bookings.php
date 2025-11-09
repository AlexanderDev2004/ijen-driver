<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->date('date');
            $table->integer('people')->default(1);
            $table->boolean('has_children')->default(false);
            $table->integer('children_count')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending','confirmed','sent_to_wa'])->default('pending');
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }
    public function down(){
        Schema::dropIfExists('bookings');
    }
};
