<?php


/**
 * 模块信息
 */
return [
    // 模块名[必填]
    'name'        => 'member',
    // 模块标题[必填]
    'title'       => '会员管理',
    // 模块唯一标识[必填]，格式：模块名.开发者标识.module
    'identifier'  => 'cms.ming.module',
    // 模块图标[选填]
    'icon'        => 'fa fa-fw fa-newspaper-o',
    // 模块描述[选填]
    'description' => '会员模块',
    // 开发者[必填]
    'author'      => 'zxgbuynow',
    // 开发者网址[选填]
    'author_url'  => 'http://www..com',
    // 版本[必填],格式采用三段式：主版本号.次版本号.修订版本号
    'version'     => '1.0.0',
    // 模块依赖[可选]，格式[[模块名, 模块唯一标识, 依赖版本, 对比方式]]
    'need_module' => [
        
    ],
    // 插件依赖[可选]，格式[[插件名, 插件唯一标识, 依赖版本, 对比方式]]
    'need_plugin' => [],
    // 数据表[有数据库表时必填]
    'tables' => [
        'member'
    ],
    // 原始数据库表前缀
    // 用于在导入模块sql时，将原有的表前缀转换成系统的表前缀
    // 一般模块自带sql文件时才需要配置
    'database_prefix' => 'game_',

    // 模块参数配置
    'config' => [
        
    ],

    // 行为配置
    'action' => [
        
    ],

    // 授权配置
    // 'access' => [
    //     'group' => [
    //         "tab_title"   => '栏目授权',
    //         "table_name"  => "cms_column",
    //         "primary_key" => "id",
    //         "parent_id"   => "pid",
    //         "node_name"   => "name"
    //     ],
    // ],
];
