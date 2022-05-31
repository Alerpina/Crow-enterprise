<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class SliderTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'sliders';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['subtitle_text', 'title_text', 'details_text', 'name'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('slider_id', $this->slider_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
