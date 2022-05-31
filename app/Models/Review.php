<?php

namespace App\Models;

use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Review extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'reviews';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['title', 'subtitle', 'details'];
    protected $fillable = ['photo'];
    public $timestamps = false;
}
