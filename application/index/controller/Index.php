<?php


namespace app\index\controller;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Index extends Home
{
     /**
     * 获取入口目录

     */
    protected function _initialize() {
        $base_file = $this->request->baseFile();
        $base_dir  = rtrim($base_file, 'index.php');
        $this->assign('static_dir', $base_dir. 'public/static/');
    }      

    public function index()
    {
        return $this->fetch(); // 渲染模板
    }

}
