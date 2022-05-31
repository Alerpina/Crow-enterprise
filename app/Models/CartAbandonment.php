<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Generalsetting;

class CartAbandonment extends Model
{
    public function __construct() {
        parent::__construct();
    }

    protected $fillable = [
        'temp_cart',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
