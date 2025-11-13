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
        Schema::create('events', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('vendor_id'); // vendor yang membuat event
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('location');
    $table->date('start_date');
    $table->date('end_date')->nullable();
    $table->decimal('price', 10, 2);
    $table->string('image')->nullable();
    $table->timestamps();

    $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
});

Schema::table('events', function (Blueprint $table) {
    $table->renameColumn('vendor_id', 'user_id');
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
