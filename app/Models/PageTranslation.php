<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class PageTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'pages';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'details', 'meta_tag', 'meta_description'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('page_id', $this->page_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
