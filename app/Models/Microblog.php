<?php

namespace App\Models;

class Microblog extends Model
{
    protected $fillable = ['content', 'user_id', 'category_id', 'reply_count', 'like_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
}
