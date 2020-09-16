<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['name'];

    public function articles() {
        return $this->hasMany('App\Article');
    }
}
