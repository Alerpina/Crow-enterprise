<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Partner extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'logo_sliders';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = ['link','photo'];

    public $timestamps = false;

}