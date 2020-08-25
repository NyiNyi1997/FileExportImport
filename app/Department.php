<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function position(){
        return $this->hasMany('App\Position');
    }
}
