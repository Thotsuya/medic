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
        Schema::table('attentions', function (Blueprint $table) {

            $table->after('status',function(Blueprint $table){
                $table->string('observations')->nullable();
                $table->float('price')->nullable();
                $table->float('price_USD')->nullable();
                $table->date('start_date')->nullable();
            });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attentions', function (Blueprint $table) {
            $table->dropColumn('observations');
            $table->dropColumn('price');
            $table->dropColumn('price_USD');
            $table->dropColumn('start_date');
        });
    }
};
