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
        Schema::create('destocks', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_id');
            $table->text('notes')->nullable();
            $table->integer('removed')->nullable();
            $table->date('date')->nullable();
            $table->integer('lbs')->nullable();
            $table->integer('oz')->nullable();
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
        Schema::dropIfExists('destocks');
    }
};
