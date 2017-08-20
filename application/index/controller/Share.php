<?php


namespace app\index\controller;
use \think\Request;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Share extends Home
{

    public function index()
    {
        $request = Request::instance();
        $params = $request->param();

        $token = $params['token'];
        if ($token) {
            $uid = decrypt($token);
            //谁的
            $info = db('member')->where('id',$uid)->find();
            //获得树
            $trees = db('trees')->where('user_id',$uid)->count();
            //获取赞
            $zans = db('zan')->where('user_id',$uid)->count();
        }
        $this->assign('info', $info);
        $this->assign('zans', $zans);
        $this->assign('trees', $trees); 
        return $this->fetch(); // 渲染模板
    }

}
