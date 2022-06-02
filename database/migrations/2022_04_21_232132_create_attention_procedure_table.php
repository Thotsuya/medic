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
        Schema::create('attention_procedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attention_id')->constrained();
            $table->foreignId('procedure_id')->constrained();
            $table->float('price');
            $table->float('price_USD');
            $table->integer('amount');
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
        Schema::dropIfExists('attention_procedure');
    }
};
