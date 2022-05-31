<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends CachedModel
{
    protected $fillable = ['product_id','photo'];
    public $timestamps = false;
}
