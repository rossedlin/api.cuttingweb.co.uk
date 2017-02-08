<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 08/02/2017
 * Time: 19:32
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Analytics2 extends Migration
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
			$table->dropColumn('ip');
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
		Schema::table('cry_google_analytics_ip', function (Blueprint $table)
		{
			$table->string('ip', 255)->unique();
			$table->dropColumn('address');
			$table->dropColumn('type');
		});
	}
}