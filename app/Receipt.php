<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    public function groups()
    {
        return $this->BelongsToMany('App\Group');
    }

    public function user()
    {
        return $this->BelongsTo('App\User');
    }
}
