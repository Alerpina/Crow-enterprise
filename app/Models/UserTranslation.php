<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class UserTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'customers';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['shop_message'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('user_id', $this->user_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
