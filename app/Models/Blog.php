<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
     protected $guarded=[];

     public function categories(){
          return $this->belongsTo('App\Models\Category','id_cate');
     }
}
