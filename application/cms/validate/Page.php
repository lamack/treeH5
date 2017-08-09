<?php


namespace app\cms\validate;

use think\Validate;

/**
 * 单页验证器
 * @package app\cms\validate
 * @author 蔡伟明 <314013107@qq.com>
 */
class Page extends Validate
{
    // 定义验证规则
    protected $rule = [
        'title|页面标题'  => 'require|length:1,30'
    ];

    // 定义验证场景
    protected $scene = [
        'title' => ['title']
    ];
}
