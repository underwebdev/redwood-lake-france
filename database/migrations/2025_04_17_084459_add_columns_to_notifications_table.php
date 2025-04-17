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
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['reminder', 'overdue', 'welcome', 'review']);
            $table->string('type');
            $table->string('recipient');
            $table->datetime('sent');
            $table->datetime('delivered')->nullable();
            $table->datetime('opened')->nullable();
            $table->string('mailhook_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['type', 'recipient', 'sent', 'delivered', 'opened', 'mailhook_id']);
        });
    }
};
