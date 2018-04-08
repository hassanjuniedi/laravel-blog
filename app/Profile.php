<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Profile
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Profile extends Model
{
    protected $fillable = ['avatar','about','facebook','twitter', 'user_id'];
    public function user() {
        return $this->belongsTo('App\User');
    }
}
