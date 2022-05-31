<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Socialsetting extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'socials';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = ['facebook', 'twitter','linkedin', 'dribble', 'instagram', 'youtube', 'y_status', 'f_status', 't_status', 'l_status', 'd_status','i_status','f_check','g_check','fclient_id','fclient_secret','fredirect','gclient_id','gclient_secret','gredirect'];
    public $timestamps = false;
}
