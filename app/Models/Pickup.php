<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Pickup extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'pickups';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    protected $translatedAttributes = ['location'];
    protected $guarded = ['id'];
    public $timestamps = false;
}
