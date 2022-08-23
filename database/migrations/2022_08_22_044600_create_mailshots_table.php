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
        Schema::create('mailshots', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('title');
            $table->longtext('body');
            $table->datetime('scheduled')->nullable();
            $table->string('link')->nullable();
            $table->datetime('sent')->nullable();
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
        Schema::dropIfExists('mailshots');
    }
};
