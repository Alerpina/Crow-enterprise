<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class BlogTranslation extends CachedModel
{
    use LogsActivity;
    
    protected static $logName = 'blogs';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'details', 'meta_tag', 'meta_description', 'tags'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('blog_id', $this->blog_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
