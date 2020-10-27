<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJatahCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jatah_cuti', function (Blueprint $table) {
            $table->id('jatah_id');
            $table->bigInteger('id');
            $table->integer('jatah_cuti');
            $table->timestamps();
        });

        Schema::table('jatah_cuti', function (Blueprint $table) {
            $table->foreign('id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jatah_cuti');
    }
}
