<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class TeamMemberCategoryTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'team_member_categories';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['name'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('team_member_category_id', $this->team_member_category_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
