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
        Schema::create('procedure_valuation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained();
            $table->foreignId('valuation_id')->constrained();
            $table->integer('amount')->default(0);
            $table->float('discount')->default(0);
            $table->float('price');
            $table->float('price_USD');
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
        Schema::dropIfExists('procedure_valuation');
    }
};
