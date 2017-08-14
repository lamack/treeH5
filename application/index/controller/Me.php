<?php


namespace app\index\controller;
use \think\Request;
/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Me extends Home
{
          

    public function index()
    {
        //取用户
        $member = session('_MEMBER');

        //奖品
        $award = db('recode')->where('user_id',$member['id'])->select();
        $this->assign('award', $award);
        $this->assign('_MEMBER', $member);

        return $this->fetch(); // 渲染模板
    }

    public function award()
    {
        $request = Request::instance();
        $params = $request->param();
        if (!$params||!$params['id']) {
            $data = ['msg'=>'参数缺失','status'=>'error'];
            return json($data);
        }
        $conpon = db('conpon')->alias('a')->join(' conpon_type b',' b.id = a.conpon_type','LEFT')->where('a.id',$params['id'])->find();
        // print_r($conpon);exit;
        $this->assign('conpon', $conpon);
        return $this->fetch(); // 渲染模板
    }

}
