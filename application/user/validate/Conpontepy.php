<?php


namespace app\user\validate;

use think\Validate;

/**
 * 验证器
 * @package app\admin\validate
 */
class Conpontepy extends Validate
{
    //定义验证规则
    protected $rule = [
        'conpon_name|优惠券名'      => 'require',
        'conpon_parnter|合伙伙伴'      => 'require',
        'conpon_code|代号'      => 'require',
        'conpon_introduce|使用说明'      => 'require',
    ];

    //定义验证提示
    protected $message = [
        'conpon_name.require' => '必填项不能为空',
        'conpon_parnter.require' => '必填项不能为空',
        'conpon_code.require' => '必填项不能为空',
        'conpon_introduce.require' => '必填项不能为空',
    ];

   
}
