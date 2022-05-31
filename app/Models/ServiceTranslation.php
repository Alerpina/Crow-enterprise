<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'services';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'details'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('service_id', $this->service_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
