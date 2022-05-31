<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class TeamMember extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'team_members';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = ['name', 'category_id', 'photo', 'whatsapp', 'skype', 'email'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(TeamMemberCategory::class, 'category_id');
    }

}
