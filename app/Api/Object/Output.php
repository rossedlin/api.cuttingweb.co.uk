<?php
namespace App\Api\Object;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 13/01/2017
 * Time: 17:10
 *
 * Class Output
 * @package App\Api\Object\Output
 */
class Output
{
	const _REQUEST  = 'request';
	const _RESPONSE = 'response';
	const _PAYLOAD  = 'payload';

	const _METHOD       = 'method';
	const _DATETIME     = 'datetime';
	const _MICRO_TIMING = 'micro_timing';

	/**
	 * @var array $request
	 */
	private $request = [];

	/**
	 * @var array $response
	 */
	private $response = [];

	/**
	 * @var array $payload
	 */
	private $payload = [];

	/**
	 * @var int $timingStart
	 */
	private $timingStart;

	/**
	 * @var int $timingEnd
	 */
	private $timingEnd;

	/**
	 * Output constructor.
	 */
	public function __construct()
	{
		$this->timingStart = microtime();

//        "code": "HTTP\/404",
//        "description": "Endpoint not found",
//        "reference": "3B61B585-258D-8C60-2E47-17F0FB41390A",
//        "datetime": 1484323000,
//        "endpoint": "\/"

		$this->request = [
//			'status' => 'error',
//			self::_METHOD => $request->getMethod(),
		];

//		  "status": "error",
//        "code": "HTTP\/404",
//        "reference": "F485B41B-3366-97FB-BF4F-87C4DEAC7E18",
//        "description": "Endpoint not found",
//        "rowcount": 0,
//        "timings": 0.0664570331573

		$this->response = [
//			'status' => 'error',
		];
	}

	/**
	 * @return array
	 */
	public function getPayload()
	{
		return (array)$this->payload;
	}

	/**
	 * @param array $payload
	 */
	public function setPayload(array $payload)
	{
		$this->payload = (array)$payload;
	}

	/**
	 * @return array
	 */
	private function _toArray()
	{
		$this->response[self::_DATETIME]     = time();
		$this->timingEnd                     = microtime();
		$this->response[self::_MICRO_TIMING] = $this->timingEnd - $this->timingStart;

		return [
			self::_REQUEST  => $this->request,
			self::_RESPONSE => $this->response,
			self::_PAYLOAD  => $this->payload,
		];
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return $this->_toArray();
	}

	/**
	 * @return string
	 */
	public function toJson()
	{
		return json_encode($this->_toArray(), JSON_PRETTY_PRINT);
	}
}