<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSzervizkonyvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('szervizkonyv', function (Blueprint $table) {
            $table->integer('id',9)->autoIncrement();
            $table->tinyInteger('garancialis');
            $table->timestamp('szerviz_kezdete')->nullable(false);
            $table->timestamp('szerviz_vege')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('szervizkonyv');
    }
}
