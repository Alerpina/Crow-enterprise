<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AdminLanguage extends CachedModel
{
    use LogsActivity;
    
    protected static $logName = 'admin_languages';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
}
