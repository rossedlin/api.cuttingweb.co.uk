<?php
namespace App\Api\Plugin;

use \App\Api\_Plugin;
use \Cryslo\Core\Utils;
use \App\Models;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 18/01/2017
 * Time: 15:31
 *
 * Class CheckPulse
 * @package App\Api\Plugin
 */
class CheckPulse extends _Plugin
{
	/**
	 * @param array $args
	 */
	public function __construct(array $args = [])
	{
		$code          = Utils::getFromArray($args, 'code');
		$heartbeatCode = Models\HeartbeatCode::where('code', $code)->first();

		if ($heartbeatCode instanceof Models\HeartbeatCode)
		{
			/** @var Models\Heartbeat $heartbeat */
			$heartbeat = Models\Heartbeat::where('code', $heartbeatCode->code)->orderBy('datetime_added', 'desc')->first();

			$online           = false;
			$datetime_added   = Utils::getVarObject($heartbeat, 'datetime_added', "1970-01-01 00:00:00");
			$date_added_stamp = strtotime($datetime_added);
			$now_stamp        = time();
			$diff_stamp       = $date_added_stamp - $now_stamp;

			if ($diff_stamp > -120) $online = true;

			$payload = [
				"online"         => $online,
				"last_heartbeat" => $heartbeat->datetime_added,
				"now"            => date('Y-m-d H:i:s'),
			];

			$this->render($payload);
		}

		$this->render([]);
	}
}