<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'categories';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['name'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('category_id', $this->category_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
