<?php
namespace App\Api;

use \App\Api\Object\Output;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 13/01/2017
 * Time: 15:00
 *
 * Class _Plugin
 * @package Api\Core
 */
abstract class _Plugin
{
	/**
	 * @param array $payload
	 *
	 * @return string
	 */
	protected static function render(array $payload)
	{
		$output = new Output();

		$output->setPayload($payload);

		switch (1)
		{
			case 0:
				echo "<pre>";
				print_r($output->toArray());
				echo "</pre>";
				exit;

			case 1:
				header("Content-Type: application/json");
				echo $output->toJson();
				exit;
		}

		return '';
	}

	/**
	 * @param array $args
	 */
	abstract public function __construct(array $args);
}