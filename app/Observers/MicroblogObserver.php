<?php

namespace App\Observers;

use App\Models\Microblog;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MicroblogObserver
{
    public function creating(Microblog $microblog)
    {
        //
    }

    public function updating(Microblog $microblog)
    {
        //
    }
}