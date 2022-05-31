<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BlogCategory extends LocalizedModel
{
    use LogsActivity;

    protected static $logName = 'blog_categories';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['name'];
    protected $fillable = ['slug'];
    public $timestamps = false;

    public function blogs()
    {
    	return $this->hasMany('App\Models\Blog','category_id');
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = str_replace(' ', '-', $value);
    }
}
