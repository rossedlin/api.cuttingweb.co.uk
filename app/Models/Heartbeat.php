<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $heartbeat_id
 * @property string $code
 * @property string $datetime_added
 */
class Heartbeat extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cry_heartbeat';

    /**
     * @var array
     */
    protected $fillable = ['code', 'datetime_added'];

	public function datetime_added()
	{
		return "gr";
	}

}
