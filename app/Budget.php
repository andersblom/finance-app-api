<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['name', 'slug', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function entries() {
        return $this->hasMany('App\Entry');
    }

    public function belongsToUser(User $user): bool {
        return $this->user_id == $user->id;
    }
}
