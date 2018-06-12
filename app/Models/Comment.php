<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Baum;

class Comment extends Baum\Node
{
    //
    protected $table = 'comments';
    protected $fillable = ['content','parent_id','type','from_uid','to_uid','lft','rgt','depth'];

     public function microblog()
    {

        return $this->belongsTo(Microblog::class);
        
    }

    public function user()
    {

        return $this->belongsTo(User::class,'from_uid');

    }

    public function toUser()
    {

        return $this->belongsTo(User::class,'to_uid');
        
    }

}

