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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('angler_id');
            $table->integer('specimen_id');
            $table->integer('lbs');
            $table->integer('oz');
            $table->date('date');
            $table->string('sideone')->nullable();
            $table->string('sideonethumb')->nullable();
            $table->string('sidetwo')->nullable();
            $table->string('sidetwothumb')->nullable();
            $table->text('bait')->nullable();
            $table->longtext('notes')->nullable();
            $table->integer('stock_id')->nullable();
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
        Schema::dropIfExists('reports');
    }
};
