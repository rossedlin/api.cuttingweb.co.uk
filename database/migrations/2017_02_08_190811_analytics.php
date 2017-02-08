<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 08/02/2017
 * Time: 19:08
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Analytics extends Migration
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
		Schema::create('cry_google_analytics_ip', function (Blueprint $table)
		{
			$table->increments('google_analytics_ip_id');
			$table->string('ip', 255)->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cry_google_analytics_ip');
	}
}