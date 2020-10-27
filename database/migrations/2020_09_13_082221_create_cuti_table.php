<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id('cuti_id');
            $table->bigInteger('id');
            $table->date('start');
            $table->date('finish');
            $table->string('needs', 255);
            $table->boolean('status')->default('false');
            $table->timestamps();
        });

        Schema::table('cuti', function (Blueprint $table) {
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
        Schema::dropIfExists('cuti');
    }
}
