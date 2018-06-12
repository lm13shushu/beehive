<?php

use App\Models\Comment;

return [
    // 页面标题
    'title'   => '微博回复',

    // 模型单数，用作页面『新建 $single』
    'single'  => '微博回复',

    // 数据模型，用作数据的 CRUD
    'model'   => Comment::class,

    // 设置当前页面的访问权限，通过返回布尔值来控制权限。
    // 返回 True 即通过权限验证，False 则无权访问并从 Menu 中隐藏
    // 'permission'=> function()
    // {
    //     return Auth::user()->can('manage_contents');
    // },

    // 字段负责渲染『数据表格』，由无数的『列』组成，
    'columns' => [

        // 列的标示，这是一个最小化『列』信息配置的例子，读取的是模型里对应
        // 的属性的值，如 $model->id
        'id',

        'content' => [
            // 数据表格里列的名称，默认会使用『列标识』
            'title'  => '回复内容',
            // 是否允许排序
            'sortable' => false,
        ],

        'from_uid' => [
            'title'    => '回复用户',
            'sortable' => false,
            'output' => function ($value, $model) {
                $user = $model->user;
                $title = '<img src="'.$user->avatar.'" style="height:22px;width:22px">'.e($user->name);
                return model_link($title, $user, $prefix='');
            },
        ],

        'to_uid' => [
            'title'    => '被回复用户',
            'sortable' => false,
            'output' => function ($value, $model) {
                $user = $model->toUser;
                $title = '<img src="'.$user->avatar.'" style="height:22px;width:22px">'.e($user->name);
                return model_link($title, $user, $prefix='');
            },
        ],

        'microblog_id' => [
            'title' => '被回复用户的微博id',
            'sortable' => false,
            'output' =>function ($value,$model){
                 $microblogModel = $model->microblog;
                if($microblogModel){ 
                    return model_link($microblogModel->id, $microblogModel, $prefix='');
                }else{
                    $parentModel_microblog=$model->getRoot()->microblog;
                     return model_link( $parentModel_microblog->id, $parentModel_microblog, $prefix='');
                }               
            }
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    // 『模型表单』设置项
    'edit_fields' => [
         'id' => [
            'title' => '标示（请慎重修改)',

            // 表单条目标题旁的『提示信息』
            'hint' => '修改权限标识会影响代码的调用，请不要轻易更改。'
        ],
    ],

    // 『数据过滤』设置
    'filters' => [
        'id' => [
            // 过滤表单条目显示名称
            'title' => '回复 ID',
        ],
        'microblog_id' => [
            'title' => '微博ID',
        ],
        'user' => [
            'title'              => '回复者',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],

        'toUser' => [
            'title'              => '被回复者',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
    ],
];