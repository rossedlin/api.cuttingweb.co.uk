<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $heartbeat_code_id
 * @property string $code
 */
class HeartbeatCode extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cry_heartbeat_code';

    /**
     * @var array
     */
    protected $fillable = ['code'];

}
