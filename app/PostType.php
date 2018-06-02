<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $table = 'types';
    protected $fillable = ['type'];

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
