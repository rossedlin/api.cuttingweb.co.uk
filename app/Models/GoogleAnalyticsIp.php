<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 08/02/2017
 * Time: 19:04
 *
 * Class GoogleAnalyticsIp
 * @package App\Models
 *
 * @property integer $id
 * @property string  $address
 * @property integer $type
 */
class GoogleAnalyticsIp extends Model
{
	const TYPE_IP     = 1;
	const TYPE_DOMAIN = 2;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'cry_google_analytics_ip';

	/**
	 * @var array
	 */
	protected $fillable = ['address', 'type'];

}
