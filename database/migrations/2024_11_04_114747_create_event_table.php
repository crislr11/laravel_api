<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('organizer_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->bigInteger('category_id')->unsigned();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('location');
            $table->decimal('latitude', 9,6);
            $table->decimal('longitude', 9,6);
            $table->integer('max_attendees');
            $table->decimal('price', 10, 2);
            $table->string(column: 'image_url')->comment('storage\images\interrogante.jpg');
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
