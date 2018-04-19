<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取faker实例
        $faker = app(Faker\Generator::class);
        //头像假数据
         $avatars = [
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        //生成数据集合
        //factory(User::class) 根据指定的 User 生成模型工厂构造器，对应加载 UserFactory.php 中的工厂设置。
        //make()方法会生成集合对象
        //each() 是 集合对象 提供的 方法，用来迭代集合中的内容并将其传递到回调函数中。
        //makeVisible() 是 Eloquent 对象提供的方法，可以显示 User 模型 $hidden 属性里指定隐藏的字段，此操作确保入库时数据库不会报错。
        $user = factory(User::class)
                                ->times(10)
                                ->make()
                                ->each(function ($user,$index) use ($faker,$avatars){
                                     $user->avatar = $faker ->randomElement($avatars);
                                });
        //让隐藏字段可见，并将数据集合转换为数组
        $user_array = $user->makeVisible(['password','remember_token'])->toArray();
        //插入数据
        User::insert($user_array);

        //单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Jay';
        $user->email = 'Jay@email.com';
        $user->password=bcrypt('123456');
        $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->save();
    }
}
