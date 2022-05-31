<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Childcategory extends LocalizedModel
{
    use LogsActivity;
    
    protected static $logName = 'child categories';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];

    public $translatedAttributes = ['name'];
    protected $fillable = ['subcategory_id','slug', 'category_id','status','ref_code', 'banner'];
    public $timestamps = false;

    public function subcategory()
    {
    	return $this->belongsTo('App\Models\Subcategory')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Category')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function attributes() {
        return $this->morphMany('App\Models\Attribute', 'attributable');
    }

    public function getBannerLinkAttribute() {
        return $this->banner ? asset('assets/images/childcategories/banners/'.$this->banner) : null;
    }
}
