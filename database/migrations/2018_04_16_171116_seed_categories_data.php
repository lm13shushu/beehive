<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
             [
                'name'        => '日常',
                'description' => '分享每日精彩',
            ],
            [
                'name'        => '热点',
                'description' => '当下焦点现象，社会关注话题',
            ],
            [
                'name'        => '广告',
                'description' => '微广告，大效应',
            ],
            [
                'name'        => '分享',
                'description' => '有意思的东西不要藏着掖着',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    //down() 在回滚迁移时会被调用，是 up() 方法的逆反操作。truncate() 方法为清空 catetories 数据表里的所有数据。
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
