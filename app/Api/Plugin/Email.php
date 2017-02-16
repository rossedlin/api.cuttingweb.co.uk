<?php
namespace App\Api\Plugin;

use Illuminate\Http\Request;
use \App\Api\_Plugin;
use \Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 16/02/2017
 * Time: 10:32
 *
 * Class Ping
 * @package App\Api\Plugin
 */
class Email //extends _Plugin
{
	/**
	 * Email constructor.
	 *
	 * @param Request $request
	 * @param array   $args
	 */
	public function __construct(Request $request, array $args = [])
	{
		/**
		 * Validate IP Address
		 */
		$ips = [
			'81.111.95.119',
		];

		if (!in_array($request->ip(), $ips))
		{
			abort(404);
		}

		/**
		 * Validate Token
		 */
		$token = $request->get('token');
		if ($token !== 'th34t34gh340gh3784gh348gh3')
		{
			abort(404);
		}


		$to      = $request->get('to');
		$from    = $request->get('from');
		$subject = $request->get('subject', 'Cryslo Team');
		$message = $request->get('message');
		
		$message = Core\Email::getTemplate('Default', [
			'content' => $message,
		]);

		pre(Core\Email::sendHtml([$to], [$from], $subject, $message));


//		echo json_encode($request->toArray(), JSON_PRETTY_PRINT);
		exit;

//		$this->render([]);
	}
}