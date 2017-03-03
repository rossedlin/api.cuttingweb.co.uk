<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		/**
		 * Add the Email Blocklist Table
		 */
		if (!Schema::hasTable('cry_email_blocklist'))
		{
			Schema::create('cry_email_blocklist', function (Blueprint $table)
			{
				$table->increments('email_blocklist_id');
				$table->string('email', 255)->unique();
			});
		}

		/**
		 * Add the Heartbeat Table
		 * This is a record table of each pulse
		 */
		if (!Schema::hasTable('cry_heartbeat'))
		{
			Schema::create('cry_heartbeat', function (Blueprint $table)
			{
				$table->increments('heartbeat_id');
				$table->string('code', 50);
				$table->timestamp('datetime_added');
			});
		}

		/**
		 * Add the Heartbeat Code Table
		 */
		if (!Schema::hasTable('cry_heartbeat_code'))
		{
			Schema::create('cry_heartbeat_code', function (Blueprint $table)
			{
				$table->increments('heartbeat_code_id');
				$table->string('code', 50);
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if (Schema::hasTable('cry_email_blocklist')) Schema::drop('cry_email_blocklist');
		if (Schema::hasTable('cry_heartbeat')) Schema::drop('cry_heartbeat');
		if (Schema::hasTable('cry_heartbeat_code')) Schema::drop('cry_heartbeat_code');
    }
}
