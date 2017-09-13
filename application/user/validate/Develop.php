<?php


namespace app\user\validate;

use think\Validate;

/**
 * 验证器
 * @package app\admin\validate
 * @author 蔡伟明 <314013107@qq.com>
 */
class Develop extends Validate
{
    //定义验证规则
    protected $rule = [
        'cash_trees|树苗兑换'      => 'require',
        // 'lives_tree|成长值'      => 'require',
        // 'develop_day|自然生长增加'      => 'require',
        // 'lives_drought|干旱减掉生命值'      => 'require',
        // 'lives_flood|洪水减掉生命值'      => 'require',
        // 'lives_typhoon|台风减掉生命值'      => 'require',
    ];

    //定义验证提示
    protected $message = [
        'cash_trees.require' => '必填项不能为空',
        // 'lives_tree.require' => '必填项不能为空',
        // 'develop_day.require' => '必填项不能为空',
        // 'lives_drought.require' => '必填项不能为空',
        // 'lives_flood.require' => '必填项不能为空',
        // 'lives_typhoon.require' => '必填项不能为空',
    ];

   
}
