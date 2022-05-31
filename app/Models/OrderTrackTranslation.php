<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderTrackTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'order_tracks';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'text'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('order_track_id', $this->order_track_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
