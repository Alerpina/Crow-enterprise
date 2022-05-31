<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Attribute extends LocalizedModel
{

    use LogsActivity;
    
    protected static $logName = 'attributes';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];

    public $translatedAttributes = ['name'];
    protected $fillable = ['attributable_id', 'attributable_type', 'input_name', 'price_status', 'show_price', 'details_status'];

    public function attributable() {
      return $this->morphTo();
    }

    public function attribute_options() {
      return $this->hasMany('App\Models\AttributeOption');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->causer_id = auth('admin')->user()->id;
        $activity->causer_type = Admin::class;
    }
}
