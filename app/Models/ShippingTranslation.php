<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class ShippingTranslation extends CachedModel
{
    use LogsActivity;
    
    protected static $logName = 'shippings';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'subtitle', 'delivery_time'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('shipping_id', $this->shipping_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
