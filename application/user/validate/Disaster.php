<?php


namespace app\user\validate;

use think\Validate;

/**
 * 验证器
 * @package app\admin\validate
 */
class Disaster extends Validate
{
    //定义验证规则
    protected $rule = [
        'disaster_type|灾害类型'      => 'require',
        'start_time|触发开始时间'      => 'require',
        'end_time|触发结束时间'      => 'require',
        'push_flish_time|公告发布时间'      => 'require',
        'push_content|公告内容'      => 'require',
    ];

    //定义验证提示
    protected $message = [
        'disaster_type.require' => '必填项不能为空',
        'start_time.require' => '必填项不能为空',
        'end_time.require' => '必填项不能为空',
        'push_flish_time.require' => '必填项不能为空',
        'push_content.require' => '必填项不能为空',
    ];

   
}
