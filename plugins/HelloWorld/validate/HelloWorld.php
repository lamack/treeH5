<?php


namespace plugins\HelloWorld\validate;

use think\Validate;

/**
 * 后台插件验证器
 * @package app\plugins\HelloWorld\validate
 */
class HelloWorld extends Validate
{
    //定义验证规则
    protected $rule = [
        'name|出处' => 'require',
        'said|名言' => 'require',
    ];
}
