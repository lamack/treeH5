<?php


namespace app\cms\validate;

use think\Validate;

/**
 * 导航验证器
 * @package app\cms\validate
 * @author 蔡伟明 <314013107@qq.com>
 */
class Nav extends Validate
{
    // 定义验证规则
    protected $rule = [
        'tag|菜单标识' => 'require|length:1,30|unique:cms_nav',
        'title|菜单标题' => 'require|length:1,30|unique:cms_nav'
    ];

    // 定义验证场景
    protected $scene = [
        'tag' => ['tag'],
        'title' => ['title']
    ];
}
