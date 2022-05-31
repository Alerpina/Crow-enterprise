<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Banner extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'banners';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = ['photo','link','type'];

    protected $storeSettings;

    public function __construct() {

        $this->storeSettings = resolve('storeSettings');

        parent::__construct();
    }


    public function stores()
    {
        return $this->belongsToMany('App\Models\Generalsetting','banner_store','banner_id','store_id');
    }

    public function scopeByStore($query)
    {
        return $query->whereHas('stores', function ($query) {
            $query->where('store_id', $this->storeSettings->id);
        });
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function getUpdatedAtAttribute($value)
    {
        if(!empty($value)) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->formatLocalized('%d/%m/%Y, %T');
        }
    }
}
