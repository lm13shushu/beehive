<?php

use Illuminate\Database\Seeder;
use App\Models\Microblog;

class MicroblogsTableSeeder extends Seeder
{
    public function run()
    {
        $microblogs = factory(Microblog::class)->times(50)->make()->each(function ($microblog, $index) {
            if ($index == 0) {
                // $microblog->field = 'value';
            }
        });

        Microblog::insert($microblogs->toArray());
    }

}

