<?php


namespace app\index\controller;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class other extends Home
{
        

    public function index()
    {
        return $this->fetch(); // 渲染模板
    }

}
