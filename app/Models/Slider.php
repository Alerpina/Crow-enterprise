<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'sliders';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $storeSettings;
    
    protected $translatedAttributes = ['subtitle_text', 'title_text', 'details_text', 'name'];
    protected $fillable = ['subtitle_size', 'subtitle_color', 'subtitle_anime', 'title_size', 'title_color', 'title_anime', 'details_size', 'details_color', 'details_anime', 'photo', 'position', 'link','status'];

    public function __construct() {

        $this->storeSettings = resolve('storeSettings');

        parent::__construct();
    }

    public function stores(){
        return $this->belongsToMany('App\Models\Generalsetting','slider_store','slider_id','store_id');
    }

    public function scopeByStore($query){
        return $query->whereHas('stores', function ($query) {
            $query->where('store_id', $this->storeSettings->id);
        });
    }

    public function scopeIsActive($query){
        return $query->where('status', 1);
    }

    public function getUpdatedAtAttribute($value){
        if(!empty($value)) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->formatLocalized('%d/%m/%Y, %T');
        }
    }
}
