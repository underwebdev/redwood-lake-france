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
        Schema::create('photodiaries', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('thumbnail');
            $table->text('caption')->nullable();
            $table->date('date');
            $table->integer('is_featured')->nullable();
            $table->integer('orientation');
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
        Schema::dropIfExists('photodiaries');
    }
};
