<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_type_id')->nullable()->constrained('organization_types')->onDelete('cascade')->onUpdate('cascade');
            $table->text('image')->nullable();
            $table->text('cover_image')->nullable();
            $table->text('contact')->nullable();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
            $table->string('email')->nullable();
            $table->integer('type')->nullable();
            $table->text('website')->nullable();
            $table->decimal('latitude', 15, 11)->nullable();
            $table->decimal('longitude', 15, 11)->nullable();
            $table->boolean('isPublic')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
