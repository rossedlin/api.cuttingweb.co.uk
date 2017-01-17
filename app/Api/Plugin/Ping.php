<?php
namespace App\Api\Plugin;

use \App\Api\_Plugin;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 13/01/2017
 * Time: 14:08
 *
 * Class Ping
 * @package App\Api\Plugin
 */
class Ping extends _Plugin
{
	/**
	 * @param array $args
	 */
	public function __construct(array $args = [])
	{
		if (preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $args['ip']))
		{
			$this->render([
				'ip'     => $args,
				'result' => $this->_pingAddress($args['ip']),
			]);
		}

		$this->render(["Bad IP"]);
	}

	private function _pingAddress($ip)
	{
		exec("/bin/ping -c 4 $ip", $outcome, $status);

		return $outcome;
	}
}