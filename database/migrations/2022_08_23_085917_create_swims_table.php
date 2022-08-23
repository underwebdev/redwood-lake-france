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
        Schema::create('swims', function (Blueprint $table) {
            $table->id();
            $table->integer('lake_id');
            $table->string('name');
            $table->string('shortname');
            $table->string('photo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });

        DB::table('swims')->insert(
        array(['lake_id' => '1', 'name' => 'Swim One', 'shortname' => '1'],
            ['lake_id' => '1', 'name' => 'Swim Two', 'shortname' => '2'],
            ['lake_id' => '1', 'name' => 'Swim Three', 'shortname' => '3'],
            ['lake_id' => '1', 'name' => 'Swim Four', 'shortname' => '4'],
            ['lake_id' => '1', 'name' => 'Swim Five', 'shortname' => '5'],
            ['lake_id' => '1', 'name' => 'Swim Six', 'shortname' => '6'],
            ['lake_id' => '1', 'name' => 'Swim Seven', 'shortname' => '7'],
            ['lake_id' => '1', 'name' => 'Swim Eight', 'shortname' => '8'],
            ['lake_id' => '1', 'name' => 'Swim Nine', 'shortname' => '9']
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swims');
    }
};
