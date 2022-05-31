<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class TeamMemberCategory extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'team_member_categories';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];

    protected $table = 'team_member_categories';

    public $translatedAttributes = ['name'];
    protected $guarded = ['id'];

    public $timestamps = false;

    public function team_members()
    {
        return $this->hasMany(TeamMember::class, 'category_id');
    }

    public function scopeWithWhatsapp($query)
    {
        return $query->whereHas(
            'team_members',
            function (
                Builder $query
            ) {
                $query->whereNotNull('whatsapp');
            }
        );
    }
}
