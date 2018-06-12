<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    //
    protected $fillable = [
        'name','description',
    ];

    public function microblogs()
    {

        return $this->hasMany(Microblog::class);
        
    }
    
}
