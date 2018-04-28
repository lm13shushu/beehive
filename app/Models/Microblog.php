<?php

namespace App\Models;

class Microblog extends Model
{
    protected $fillable = ['content', 'category_id', 'order', 'excerpt', 'slug'];

    public function category()
    {

        return $this->belongsTo(Category::class);  

    }

    public function user()
    {

        return $this->belongsTo(User::class);
        
    }

    public function replies()
    {

        return $this->hasMany(Reply::class);
        
    }

    public function comments()
    {

        return $this->hasMany(Comment::class);
        
    }

}
