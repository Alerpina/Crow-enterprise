<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends CachedModel
{
	use LogsActivity;
    
    protected static $logName = 'reports';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $fillable = ['product_id', 'user_id','title','note'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }

    public function product()
    {
    	return $this->belongsTo('App\Models\Product')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }

}
