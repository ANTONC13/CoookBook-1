<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'img_file_name', 'description',
    ];

    public function receipts()
    {
        return $this->BelongsToMany('App\Receipt');
    }
}
