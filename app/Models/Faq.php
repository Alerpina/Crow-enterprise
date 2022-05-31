<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Faq extends LocalizedModel
{
    use LogsActivity;
    
    protected static $logName = 'faqs';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['title', 'details'];
    protected $guarded = ['id'];
    public $timestamps = false;
}
