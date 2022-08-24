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
        Schema::create('priceguides', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->string('name')->nullable();
            $table->date('start');
            $table->date('end');
            $table->integer('price');
            $table->integer('deposit');
            $table->integer('due');
            $table->integer('featured')->nullable();
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
        Schema::dropIfExists('priceguides');
    }
};
