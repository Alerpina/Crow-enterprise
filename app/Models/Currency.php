<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Currency extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'currencies';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = ['name', 'sign', 'value','decimal_separator','thousands_separator','decimal_digits','is_default', 'description'];
    public $timestamps = false;
}
