<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class PickupTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'pickups';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    public $timestamps = false;
    protected $fillable = ['location'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('pickup_id', $this->pickup_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
