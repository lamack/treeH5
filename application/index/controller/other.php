<?php


namespace app\index\controller;
use \think\Request;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class other extends Home
{
        

    public function index()
    {
        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt(session('_MEMBER')['id']));
        }
        $request = Request::instance();
        $params = $request->param();
        //获得用户id
        $info = [];
        if ($params&&$params['id']) {
            $info = db('member')->where('id',$params['id'])->find();
        }
        
        $this->assign('info', $info); 
        return $this->fetch(); // 渲染模板
    }

}
