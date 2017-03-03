<?php
namespace App\Api\Plugin\Google\Analytics;

use Illuminate\Http\Request;
use \App\Api\_Plugin;
use \Cryslo\Core\Utils;
use \App\Models;
use \Cryslo\Core;

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
	 * ExcludeIP constructor.
	 *
	 * @param Request $request
	 * @param array   $args
	 */
	public function __construct(Request $request, array $args = [])
	{
		switch ($request->getMethod())
		{
			case Request::METHOD_GET:
				$this->get($request);
				break;
			case Request::METHOD_POST:
				$this->post($request);
				break;
		}
	}

	/**
	 * @param Request $request
	 */
	private function get(Request $request)
	{
//		$redis = new \Predis\Client();
//		$redis->expire(self::REDIS_KEY, 3600);

		$payload = false;
//		$payload = unserialize($redis->get(self::REDIS_KEY));

		if (!is_array($payload))
		{
			$payload = [];

			/** @var Models\Heartbeat $heartbeat */
			$ips = Models\GoogleAnalyticsIp::all();

			foreach ($ips as $ip)
			{
				$address = Utils::getVarObject($ip, 'address', false);
				$type    = (int)Utils::getVarObject($ip, 'type', false);

				switch ($type)
				{
					case Models\GoogleAnalyticsIp::TYPE_DOMAIN:
						$payload[] = gethostbyname($address);
						break;

					case Models\GoogleAnalyticsIp::TYPE_IP:
						$payload[] = $address;
						break;
				}
			}

//			$redis->set(self::REDIS_KEY, serialize($payload));
		}

		$this->render($payload);
	}

	/**
	 * @param Request $request
	 */
	private function post(Request $request)
	{
		/**
		 * Validate Secret
		 */
		$secret = $request->get('secret');
		if ($secret !== 'urqprJWh5OxfJCnWDrpC')
		{
			abort(404);
		}

		/**
		 * Get the IP from the Request
		 */
		$ip = $request->get('ip', Core\Request::server(Core\Consts::REMOTE_ADDR));

		/**
		 * Validate the IP
		 */
		if (!Core\Utils::isValidIp($ip))
		{
			abort(404);
		}

		/**
		 * Retrieve the record if it exists
		 * Insert/Update the IP
		 */
		$googleAnalyticsIp = Models\GoogleAnalyticsIp::where('address', $ip)->first();

		if (!($googleAnalyticsIp instanceof Models\GoogleAnalyticsIp))
		{
			$googleAnalyticsIp = new Models\GoogleAnalyticsIp;
		}

		$googleAnalyticsIp->address = $ip;
		$googleAnalyticsIp->type    = Models\GoogleAnalyticsIp::TYPE_IP;
		$googleAnalyticsIp->save();

		$this->render([
			'success'      => $googleAnalyticsIp->save(),
			'ip' => $ip,
		]);
	}
}