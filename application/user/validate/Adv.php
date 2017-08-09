<?php


namespace app\user\validate;

use think\Validate;

/**
 * 验证器
 * @package app\admin\validate
 */
class Adv extends Validate
{
    //定义验证规则
    protected $rule = [
        'adv_type|公告类型'      => 'require',
        'adv_title|标题'      => 'require',
        'adv_content|内容'      => 'require',
        'adv_status|公告状态'      => 'require',
    ];

    //定义验证提示
    protected $message = [
        'adv_type.require' => '必填项不能为空',
        'adv_title.require' => '必填项不能为空',
        'adv_content.require' => '必填项不能为空',
        'adv_status.require' => '必填项不能为空',
    ];

   
}
