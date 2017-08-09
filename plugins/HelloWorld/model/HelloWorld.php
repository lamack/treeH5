<?php


namespace plugins\HelloWorld\model;

use app\common\model\Plugin;

/**
 * 后台插件模型
 * @package plugins\HelloWorld\model
 */
class HelloWorld extends Plugin
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__PLUGIN_HELLO__';

    public function test()
    {
        // 获取插件的设置信息
        halt('test');
    }
}