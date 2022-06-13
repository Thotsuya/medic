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
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->longText('boton');
            $table->text('nombtrata');
            $table->string('classbtn1');
            $table->string('classbtn2');
            $table->string('classbtn3');
            $table->string('classbtn4');
            $table->string('classbtn5');
            $table->string('classbtn6');
            $table->string('classbtn7');
            $table->string('classbtn8');
            $table->string('classbtn9');
            $table->string('classbtn10');
            $table->string('classbtn11');
            $table->string('classbtn12');
            $table->string('classbtn13');
            $table->string('classbtn14');
            $table->string('classbtn15');
            $table->string('classbtn16');
            $table->string('classbtn17');
            $table->string('classbtn18');
            $table->foreignId('patient_id')->constrained();
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
        Schema::dropIfExists('maps');
    }
};
