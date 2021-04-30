<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['name', 'user_id', 'texts', 'slug', 'is_protected', 'password', 'ip'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

