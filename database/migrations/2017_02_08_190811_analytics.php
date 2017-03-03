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
	const DATE_TIME = '1970-01-01 00:00:00';
	
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
			$table->increments('id');
			$table->dateTime('updated_at')->default(self::DATE_TIME);
			$table->dateTime('created_at')->default(self::DATE_TIME);

			$table->string('address', 255)->unique();
			$table->integer('type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('cry_google_analytics_ip')) Schema::drop('cry_google_analytics_ip');
	}
}