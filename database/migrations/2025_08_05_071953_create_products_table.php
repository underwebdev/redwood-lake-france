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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longtext('description');
            $table->integer('price');
            $table->boolean('status');
            $table->timestamps();
        });

        DB::table('products')->insert([
            'name' => '25kg Pellet',
            'description' => 'Coppens pellet',
            'price' => '4000',
            'status' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
