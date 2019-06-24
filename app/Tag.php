<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function entries() {
        return $this->belongsToMany('App\Entry', 'entry_tags', 'tag_id', 'entry_id');
    }
}
