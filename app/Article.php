<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'image', 'content', 'published', 'category_id'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function scopePublished($query) {
        return $query->where('published', true);
    }
}
