<?php

use App\Models\Microblog;

return [
    'title'   => '微博',
    'single'  => '微博',
    'model'   => Microblog::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'content' => [
            'title'    => '微博',
            'sortable' => false,
        ],
        'user' => [
            'title'    => '作者',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . e($model->user->name);
                return model_link($value, $model);
            },
        ],
        'category' => [
            'title'    => '分类',
            'sortable' => false,
            // 'output'   => function ($value, $model) {
            //     return model_admin_link($model->category->name, $model->category);
            // },
        ],
        'reply_count' => [
            'title'    => '评论数量',
        ],
         'like_count' => [
            'title'    => '喜欢数量',
        ],
         'view_count' => [
            'title'    => '阅读数量',
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'id' => [
            'title' => '标示（请慎重修改)',

            // 表单条目标题旁的提示信息
            'hint' => '修改权限标识会影响代码的调用，请不要轻易更改。'
        ],
        'category' => [
            'type' => 'relationship',
            'title' => '分类',
            'name_field' => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => '微博ID',
        ],
        'user' => [
            'title'              => '微博作者',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'category' => [
            'title'              => '话题分类',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
    ],
];