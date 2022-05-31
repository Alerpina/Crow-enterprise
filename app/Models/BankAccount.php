<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BankAccount extends CachedModel
{
    use LogsActivity;
    
    protected static $logName = 'bank_accounts';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = [
        'name', 'info', 'status' 
    ];

    public $timestamps = false;
}
