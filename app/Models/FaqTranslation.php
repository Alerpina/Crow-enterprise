<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class FaqTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'faqs';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'details'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('faq_id', $this->faq_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
