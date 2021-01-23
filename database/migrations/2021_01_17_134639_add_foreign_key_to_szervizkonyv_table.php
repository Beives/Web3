<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToSzervizkonyvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('szervizkonyv', function (Blueprint $table) {
            $table->integer('auto');
            $table->foreign('auto')->references('id')->on('auto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('szervizkonyv', function (Blueprint $table) {
            //
        });
    }
}
