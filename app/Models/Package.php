<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Package extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'packages';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    protected $translatedAttributes = ['title', 'subtitle'];

    protected $fillable = ['user_id', 'price'];

    public $timestamps = false;
}
