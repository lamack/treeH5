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

    public function zan()
    {
        
        $request = Request::instance();
        $params = $request->param();

        //树
        if ($params['token']) {
            $token = decrypt($params['token']);
            $map['user_id'] = decrypt($token);;
            $map['ip'] = $_SERVER["REMOTE_ADDR"];//ip

            if (db('zan')->where($map)->find()) {
                
                $data = ['status'=>'error','msg'=>'不能重复点赞'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }else{
                $insert['user_id'] = $member['id'];
                $insert['trees_id'] = $member['trees_id'];
                $insert['num'] = 1;
                db('zan')->where($map)->insert($insert);
                $data = ['status'=>'succ','msg'=>''];

                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
        }else{
            $data = ['status'=>'error','msg'=>'参数错误'];

            return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
        }
        
        
    }
}
