<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class BlogCategoryTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'blog_categories';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['name'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('blog_category_id', $this->blog_category_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
