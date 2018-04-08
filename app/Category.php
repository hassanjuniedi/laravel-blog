<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @mixin \Eloquent
 */
class Category extends Model
{
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
