<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoEletkorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_eletkor', function (Blueprint $table) {
            $table->integer('id',9)->autoIncrement();
            $table->string('kategoria', 50);
        });

        DB::table('auto_eletkor')->insert([
            [
                'kategoria' => '0-5'
            ],
            [
                'kategoria' => '6-10'
            ],
            [
                'kategoria' => '10+'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_eletkor');
    }
}
