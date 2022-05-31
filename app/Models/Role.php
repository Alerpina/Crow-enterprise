<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Role extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'roles';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['name'];
    protected $fillable = ['section'];

    public $timestamps = false;

    public function admins()
    {
    	return $this->hasMany('App\Models\Admin');
    }


    public function sectionCheck($value)
    {
        $sections = explode(" , ", $this->section);
        if (in_array($value, $sections)){
            return true;
        }else{
            return false;
        }
        
    }

}