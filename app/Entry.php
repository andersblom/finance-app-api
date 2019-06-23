<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function budget() {
        return $this->belongsTo('App\Budget', 'budget_id');
    }
}
