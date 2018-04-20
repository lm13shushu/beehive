<?php

namespace App\Observers;

use App\Models\Microblog;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MicroblogObserver
{
    public function saving(Microblog $microblog)
    {
        //
        $microblog->excerpt = make_excerpt($microblog->content);
    }

    public function updating(Microblog $microblog)
    {
        //
    }
}