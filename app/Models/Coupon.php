<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends CachedModel
{
    use LogsActivity;


    protected $fillable = ['code', 'type', 'price', 'times', 'start_date','end_date', 'minimum_value', 'maximum_value'];
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('coupons')
            ->logFillable()
            ->logOnlyDirty();
    }
}
