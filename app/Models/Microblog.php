<?php

namespace App\Models;

class Microblog extends Model
{
    protected $fillable = ['content', 'user_id', 'category_id', 'reply_count', 'like_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {

        return $this->belongsTo(Category::class);   
    }

    public function user()
    {

        return $this->belongsTo(User::class);
        
    }

}
