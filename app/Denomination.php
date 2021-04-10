<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    protected $table = 'denomination';

    /**
     * Relationships
     */

    public function profiles()
    {
        return $this->hasMany('App\Profile');
    }
}
