<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends CachedModel
{
	use LogsActivity;
    
    protected static $logName = 'comments';
    protected static $logFillable = true;
	protected static $logOnlyDirty = true;
	
    protected $fillable = ['product_id', 'user_id','text'];

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

	public function replies()
	{
	     return $this->hasMany('App\Models\Reply');
	}

}
