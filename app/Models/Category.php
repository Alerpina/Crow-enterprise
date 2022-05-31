<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Category extends LocalizedModel
{

    use LogsActivity;
    
    protected static $logName = 'categories';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];

    public $translatedAttributes = ['name'];
    protected $fillable = ['slug','photo','is_featured','image','status', 'is_customizable', 'ref_code', 'is_customizable_number', 'banner'];
    public $timestamps = false;

    public function subs()
    {
    	return $this->hasMany('App\Models\Subcategory')->where('status','=',1);
    }

    public function childs()
    {
    	return $this->hasMany('App\Models\Childcategory')->where('status','=',1);
    }

    public function subs_order_by()
    {
    	return $this->hasMany('App\Models\Subcategory')->orderBy('slug')->where('status','=',1);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function categories_galleries()
    {
        return $this->hasMany('App\Models\CategoryGallery');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function attributes() {
        return $this->morphMany('App\Models\Attribute', 'attributable');
    }

    public function getBannerLinkAttribute() {
        return $this->banner ? asset('assets/images/categories/banners/'.$this->banner) : null;
    }
}
