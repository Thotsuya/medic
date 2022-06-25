<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('name');
            $table->string('tutor')->nullable();
            $table->string('document')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->integer('gender')->default(0);
            $table->text('observations')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
};
