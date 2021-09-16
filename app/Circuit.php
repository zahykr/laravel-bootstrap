<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    public function getPrix() {

      $prix = $this->prix / 100 ;

      return number_format($prix , 3, ',',' ') . 'DT';

    }

    public function categories(){
      return $this->belongsToMany('App\Category');
    }
}
  

