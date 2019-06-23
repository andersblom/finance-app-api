<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function entries() {
        return $this->hasMany('App\Entry');
    }
}
