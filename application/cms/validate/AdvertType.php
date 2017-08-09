<?php


namespace app\cms\validate;

use think\Validate;

/**
 * 广告分类验证器
 * @package app\cms\validate
 * @author 蔡伟明 <314013107@qq.com>
 */
class AdvertType extends Validate
{
    // 定义验证规则
    protected $rule = [
        'name|分类名称'  => 'require|length:1,30|unique:cms_advert_type'
    ];

    // 定义验证场景
    protected $scene = [
        'name' => ['name']
    ];
}
