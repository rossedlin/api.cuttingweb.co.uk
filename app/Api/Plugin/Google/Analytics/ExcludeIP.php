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
		 * Get the Domain/IP from the Request
		 */
		$ip     = $request->get('ip', false);
		$domain = $request->get('domain', false);

		/**
		 * Validate the Domain/IP
		 * Retrieve the record if it exists
		 */
		if (self::isValidDomain($domain))
		{
			$this->postDomain($domain);
		}
		elseif (Core\Utils::isValidIp($ip))
		{
			$this->postIp($ip);
		}
		elseif (Core\Utils::isValidIp(Core\Request::server('REMOTE_ADDR')))
		{
			$this->postIp(Core\Request::server('REMOTE_ADDR'));
		}

		/**
		 * Neither IP/Domain so lets die
		 */
		$this->render([
			'success' => false,
			'message' => 'Bad IP/Domain',
		]);
	}

	/**
	 * @param string $ip
	 */
	private function postIp($ip)
	{
		$googleAnalyticsIp = Models\GoogleAnalyticsIp::where('address', $ip)->first();

		/**
		 * Check $googleAnalyticsIp
		 */
		if (!($googleAnalyticsIp instanceof Models\GoogleAnalyticsIp))
		{
			$googleAnalyticsIp          = new Models\GoogleAnalyticsIp;
			$googleAnalyticsIp->address = $ip;
		}

		$googleAnalyticsIp->type = Models\GoogleAnalyticsIp::TYPE_IP;

		/**
		 * Insert/Update Record
		 */
		$success = $googleAnalyticsIp->save();

		$this->render([
			'success' => $success,
			'ip'      => $ip,
		]);
	}

	/**
	 * @param string $domain
	 */
	private function postDomain($domain)
	{
		$googleAnalyticsIp = Models\GoogleAnalyticsIp::where('address', $domain)->first();

		/**
		 * Check $googleAnalyticsIp
		 */
		if (!($googleAnalyticsIp instanceof Models\GoogleAnalyticsIp))
		{
			$googleAnalyticsIp          = new Models\GoogleAnalyticsIp;
			$googleAnalyticsIp->address = $domain;
		}

		$googleAnalyticsIp->type = Models\GoogleAnalyticsIp::TYPE_DOMAIN;

		/**
		 * Insert/Update Record
		 */
		$success = $googleAnalyticsIp->save();

		$this->render([
			'success' => $success,
			'domain'  => $domain,
		]);
	}

	/**
	 * @param string $domain
	 *
	 * @return bool
	 */
	private static function isValidDomain($domain)
	{
		/**
		 * Valid chars check
		 */
		if (!preg_match('/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i', $domain))
		{
			return false;
		}

		/**
		 * Overall length check
		 */
		if (!preg_match('/^.{1,253}$/', $domain))
		{
			return false;
		}

		/**
		 * Length of each label
		 */
		if (!preg_match('/^[^\.]{1,63}(\.[^\.]{1,63})*$/', $domain))
		{
			return false;
		}

		return true;
	}
}