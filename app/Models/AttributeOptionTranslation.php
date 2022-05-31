<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class AttributeOptionTranslation extends CachedModel
{

    use LogsActivity;

    protected static $logName = 'attribute_options';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = ['name', 'description'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('attribute_option_id', $this->attribute_option_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
        $activity->causer_id = auth('admin')->user()->id;
        $activity->causer_type = Admin::class;
    }
}
