<?php


namespace app\cms\model;

use think\Model as ThinkModel;

/**
 * 滚动图片模型
 * @package app\cms\model
 */
class Slider extends ThinkModel
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CMS_SLIDER__';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
}