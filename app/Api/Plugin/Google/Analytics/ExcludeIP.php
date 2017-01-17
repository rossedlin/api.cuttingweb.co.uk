<?php
namespace App\Api\Plugin\Google\Analytics;

use \App\Api\_Plugin;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 13/01/2017
 * Time: 17:26
 *
 * Class ExcludeIP
 * @package Api\Plugin\Google\Analytics
 */
class ExcludeIP extends _Plugin
{
	const REDIS_KEY = 'exclude_ip';

	/**
	 * @param array $args
	 */
	public function __construct(array $args = [])
	{
//		$redis = new \Predis\Client();
//		$redis->expire(self::REDIS_KEY, 3600);

		$payload = false;
//		$payload = unserialize($redis->get(self::REDIS_KEY));
		if (!is_array($payload))
		{
			$payload = [
				gethostbyname('cryslo.no-ip.biz'), //swc.cryslo.com
				'46.101.41.172', //cloud.cryslo.com
			];

//			$redis->set(self::REDIS_KEY, serialize($payload));
		}

		$this->render($payload);
	}
}