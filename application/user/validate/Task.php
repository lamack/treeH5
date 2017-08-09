<?php


namespace app\user\validate;

use think\Validate;

/**
 * 验证器
 * @package app\admin\validate
 */
class Task extends Validate
{
    //定义验证规则
    protected $rule = [
        'task_name|任务名'      => 'require',
        'task_describe|任务描述'      => 'require',
        'task_introduce|奖品说明'      => 'require',
    ];

    //定义验证提示
    protected $message = [
        'task_name.require' => '必填项不能为空',
        'task_describe.require' => '必填项不能为空',
        'task_introduce.require' => '必填项不能为空',
    ];

   
}
