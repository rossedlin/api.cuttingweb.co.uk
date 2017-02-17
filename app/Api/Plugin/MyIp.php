<?php
namespace App\Api\Plugin;

use Illuminate\Http\Request;
use \App\Api\_Plugin;
use \Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 17/02/2017
 * Time: 16:16
 *
 * Class MyIp
 * @package App\Api\Plugin
 */
class MyIp extends _Plugin
{
	/**
	 * MyIp constructor.
	 *
	 * @param Request $request
	 * @param array $args
	 */
	public function __construct(Request $request, array $args = [])
	{
		$this->render([
			'ip'     => $request->ip(),
		]);
	}
}