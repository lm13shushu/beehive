<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Microblog extends Model
{
    protected $fillable = ['content', 'category_id', 'order', 'excerpt', 'slug'];

    use Searchable;

    public function category()
    {

        return $this->belongsTo(Category::class);  

    }

    public function user()
    {

        return $this->belongsTo(User::class);
        
    }

    public function comments()
    {

        return $this->hasMany(Comment::class);
        
    }

    public function initialMicroblog()
    {

        return $this->belongsTo(Microblog::class,'initialMicroblog_Id');

    }

    public function forwardMicroblogs()
    {

        return $this->hasMany(Microblog::class,'initialMicroblog_Id','id');

    }

    //加载被转发的微博信息
    public function forwardMicroblogsOrder($created_at){
        $forwardMicroblogIds = $this->forwardMicroblogs->pluck('id')->toArray();
        $forwardMicroblogs = Microblog::whereIn('id',$forwardMicroblogIds)
                                                        ->where('created_at','<=',$created_at)
                                                        ->with('user')
                                                        ->orderBy('created_at','desc')
                                                        ->get();
        return $forwardMicroblogs;
    }    

    //定义要查询的字段
    public function toSearchableArray()
    {
        return [
            'microblog_content' => $this->content,
            'microblog_category' => $this->category,
        ];
    }

    //定义索引里的type值
    public function searchableAs()
    {
        return 'microblog';
    }
}
