<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'coupons';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = ['code', 'type', 'price', 'times', 'start_date','end_date', 'minimum_value', 'maximum_value'];
    public $timestamps = false;
}
