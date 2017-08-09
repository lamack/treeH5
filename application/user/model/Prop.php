<?php


namespace app\user\model;

use think\Model;
use think\helper\Hash;
use app\user\model\Role as RoleModel;
use think\Db;

/**
 * 道具模型
 * @package app\admin\model
 */
class Prop extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__PROP__';

}
