<?php

use Illuminate\Database\Seeder;
use App\Models\Microblog;
use App\Models\User;
use App\Models\Category;

class MicroblogsTableSeeder extends Seeder
{
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $microblogs = factory(Microblog::class)
                                        ->times(50)
                                        ->make()
                                        ->each(function ($microblog, $index) use ($user_ids,$category_ids,$faker){

                $microblog->user_id = $faker->randomElement($user_ids);
                $microblog->category_id = $faker->randomElement($category_ids);

        });

        Microblog::insert($microblogs->toArray());
    }

}

