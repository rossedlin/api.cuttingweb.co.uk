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

class Analytics4 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasColumn('cry_google_analytics_ip', 'google_analytics_ip_id'))
		{
			Schema::table('cry_google_analytics_ip', function (Blueprint $table)
			{
				$table->renameColumn('google_analytics_ip_id', 'id');
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
		if (Schema::hasColumn('cry_google_analytics_ip', 'id'))
		{
			Schema::table('cry_google_analytics_ip', function (Blueprint $table)
			{
				$table->renameColumn('id', 'google_analytics_ip_id');
			});
		}
	}
}