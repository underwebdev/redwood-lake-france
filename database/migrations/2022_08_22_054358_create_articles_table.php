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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longtext('body');
            $table->string('attachment')->nullable();
            $table->string('cover')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('admin_id');
            $table->string('metatitle')->nullable();
            $table->string('metadescription')->nullable();
            $table->string('metakeywords')->nullable();
            $table->string('url')->nullable()->unique();
            $table->integer('draft')->nullable();
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
        Schema::dropIfExists('articles');
    }
};
