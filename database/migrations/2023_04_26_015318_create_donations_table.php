<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('food_category_id')->constrained('food_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->text('image')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->decimal('latitude', 15, 11)->nullable();
            $table->decimal('longitude', 15, 11)->nullable();
            $table->string('quantity')->nullable();
            $table->integer('unit')->nullable();
            $table->dateTime('prepared_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->integer('status')->nullable();
            $table->integer('approval')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->boolean('hidden')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
