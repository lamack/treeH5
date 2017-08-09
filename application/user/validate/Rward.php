<?php


namespace app\user\validate;

use think\Validate;

/**
 * 验证器
 * @package app\admin\validate
 * @author 蔡伟明 <314013107@qq.com>
 */
class Rward extends Validate
{
    //定义验证规则
    protected $rule = [
        'green_limit|绿值最小值'      => 'require',
        'green_max|绿值最大值'      => 'require',
        'share_limit|成长币最小值'      => 'require',
        'share_max|成长币最大值'      => 'require',
    ];

    //定义验证提示
    protected $message = [
        'green_limit.require' => '必填项不能为空',
        'green_max.require' => '必填项不能为空',
        'share_limit.require' => '必填项不能为空',
        'share_max.require' => '必填项不能为空',
    ];

   
}
