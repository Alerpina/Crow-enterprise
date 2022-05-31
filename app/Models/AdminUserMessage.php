<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AdminUserMessage extends CachedModel
{
	use LogsActivity;

    protected static $logName = 'admin_messages';
    protected static $logFillable = true;
	protected static $logOnlyDirty = true;
	
    protected $fillable = ['conversation_id','message','user_id'];
	public function conversation()
	{
	    return $this->belongsTo('App\Models\AdminUserConversation','conversation_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
	}
}
