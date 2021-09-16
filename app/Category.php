<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function circuits(){
        return $this->belongsToMany('App\Circuit');
    }
}
