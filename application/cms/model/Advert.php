<?php


namespace app\cms\model;

use think\Model as ThinkModel;

/**
 * 广告模型
 * @package app\cms\model
 */
class Advert extends ThinkModel
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_ADVERT__';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    // 定义修改器
    public function setStartTimeAttr($value)
    {
        return $value != '' ? strtotime($value) : 0;
    }
    public function setEndTimeAttr($value)
    {
        return $value != '' ? strtotime($value) : 0;
    }
    public function getStartTimeAttr($value)
    {
        return $value != 0 ? date('Y-m-d', $value) : '';
    }
    public function getEndTimeAttr($value)
    {
        return $value != 0 ? date('Y-m-d', $value) : '';
    }
}