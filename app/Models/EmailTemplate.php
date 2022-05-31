<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailTemplate extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'email_templates';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['email_subject', 'email_body'];
    protected $fillable = ['email_type', 'status'];
    public $timestamps = false;
}
