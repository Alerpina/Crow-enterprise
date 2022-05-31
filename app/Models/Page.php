<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Page extends LocalizedModel
{
    use LogsActivity;
    
    protected static $logName = 'pages';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['title', 'details', 'meta_tag', 'meta_description'];
    protected $fillable = ['slug'];
    public $timestamps = false;

    public function getMetaTagAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return explode(',', $value);
    }
}
