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
        Schema::create('lakes', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->string('rodlimit');
            $table->string('open');
            $table->string('lrcommon');
            $table->string('lrmirror');
            $table->string('stock');
            $table->string('avgsize');
            $table->timestamps();
        });

        DB::table('lakes')->insert(
        array(['size' => '7 Acres', 'rodlimit' => '3', 'open' => 'All year', 'lrcommon' => '39lb 0oz', 'lrmirror' => '39lb 0oz', 'stock' => '350', 'avgsize' => '20lb']));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lakes');
    }
};
