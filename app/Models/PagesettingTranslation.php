<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class PagesettingTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'page_settings';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['contact_success', 'contact_title', 'contact_text', 'side_title', 'side_text'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('pagesetting_id', $this->pagesetting_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
