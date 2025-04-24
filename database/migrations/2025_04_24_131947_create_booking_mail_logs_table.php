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
        Schema::create('booking_mail_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->string('type');
            $table->string('recipient');
            $table->string('webhook_id');
            $table->datetime('sent');
            $table->datetime('delivered')->nullable();
            $table->datetime('opened')->nullable();
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
        Schema::dropIfExists('booking_mail_logs');
    }
};
