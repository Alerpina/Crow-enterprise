<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Service extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'services';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    protected $translatedAttributes = ['title', 'details'];
    protected $fillable = ['user_id', 'photo', 'link'];
    public $timestamps = false;
}
