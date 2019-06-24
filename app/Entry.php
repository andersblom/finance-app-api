<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function budget() {
        return $this->belongsTo('App\Budget', 'budget_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'entry_tags', 'entry_id', 'tag_id');
    }
}
