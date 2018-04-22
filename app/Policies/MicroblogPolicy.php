<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Microblog;

class MicroblogPolicy extends Policy
{

    //授权类需要在AuthServiceProvider中注册

    public function update(User $user, Microblog $microblog)
    {
        // return $microblog->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Microblog $microblog)
    {
        return $user->id === $microblog->user_id;
    }
}
