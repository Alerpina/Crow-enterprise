<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderTrack extends LocalizedModel
{
    use LogsActivity;
    
    protected static $logName = 'order_tracks';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['title', 'text'];

    protected $fillable = ['order_id'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id')->withDefault(function ($data) {
            foreach ($data->getFillable() as $dt) {
                $data[$dt] = __('Deleted');
            }
        });
    }
}
