<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class SeotoolTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'seotools';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['meta_keys','meta_description'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('seotool_id', $this->seotool_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
