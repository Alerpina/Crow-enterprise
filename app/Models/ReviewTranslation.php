<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class ReviewTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'reviews';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'subtitle', 'details'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('review_id', $this->review_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
