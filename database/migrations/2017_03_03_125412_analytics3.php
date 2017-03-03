<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 03/03/2017
 * Time: 12:54
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Analytics3 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cry_google_analytics_ip', function (Blueprint $table)
		{
			$table->dateTime('updated_at');
			$table->dateTime('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cry_google_analytics_ip', function (Blueprint $table)
		{
			$table->dropColumn('updated_at');
			$table->dropColumn('created_at');
		});
	}
}