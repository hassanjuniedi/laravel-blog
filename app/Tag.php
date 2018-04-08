<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $fillable = ['tag'];
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
