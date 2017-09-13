<?php


namespace app\index\controller;
use \think\Request;
/**
 * 控制器
 * @package app\index\controller
 */
class Adv extends Home
{
        

    public function index()
    {
        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt(session('_MEMBER')['id']));
        }

        $info = db('announcement')->where('adv_status','1')->order('id desc')->select();
        $adv = [];
        $in = [];
        foreach ($info as $key => $value) {
            if ($value['adv_type']=='1') {
                array_push($adv, $value);
            }else{
                array_push($in, $value);
            }
        }
        $this->assign('adv', $adv);
        $this->assign('in', $in);
        return $this->fetch(); // 渲染模板
    }

    public function detail()
    {
        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt(session('_MEMBER')['id']));
        }
        $request = Request::instance();
        $params = $request->param();
        $info = db('announcement')->where('id',$params['id'])->find();
        $info['type'] = $info['adv_type']=='0'?'游戏介绍':'游戏公告';
        $this->assign('info', $info);
        return $this->fetch(); // 渲染模板
    }

}
