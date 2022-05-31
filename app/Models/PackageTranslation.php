<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class PackageTranslation extends Model
{
    use LogsActivity;

    protected static $logName = 'packages';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['title', 'subtitle'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('package_id', $this->package_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
