<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $guarded=[];
   
    public function parentCate(){
    	return $this->belongsTo('App\Models\Category','parent_id');
    }
     public function products(){
    	return $this->hasMany('App\Models\Product');
    }
}
