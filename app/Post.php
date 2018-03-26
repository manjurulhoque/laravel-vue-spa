<?php

namespace App;

use Carbon\Carbon;
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
}
