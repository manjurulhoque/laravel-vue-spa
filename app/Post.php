<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'image'];
    protected $uploads = '/posts/images/';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute($image)
    {
        return $this->uploads . $image;
    }
}
