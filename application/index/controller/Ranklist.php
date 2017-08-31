<?php


namespace app\index\controller;

use app\common\controller\Common;

use \think\Request;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Ranklist extends Common
{

    /**
     * 初始化方法

     */
    protected function _initialize()
    {
        
        //资源目录
        $base_file = $this->request->baseFile();
        $base_dir  = rtrim($base_file, 'index.php');
        $this->assign('static_dir', $base_dir. 'public/static/');
        
    }

    public function index()
    {
        //获得当前登录用户
        $request = Request::instance();
        $params = $request->param();
            $advmap['adv_status'] = 1;
            $advmap['adv_type'] = 0;
            $adv = db('announcement')->where($advmap)->find();
            if ($adv) {
                $adv['type'] = '游戏介绍';
            }
            $this->assign('adv', $adv);

        if ($params&&isset($params['token'])) {
            $info = session('_MEMBER'); 
        }else{
           if (!$params||!$params['uid']) {
                session('_MEMBER',null);//每次启动游戏检测用户标识 不存在去本地session
                $data = ['msg'=>'用户sign丢失','status'=>'error'];
                return $this->fetch('error'); // 渲染模板
                return json($data);
            }
            
            //获取用户信息
            $info = db('member')->where('sign',$params['uid'])->find();
            if (!$info) {
                session('_MEMBER',null);//
                $data = ['msg'=>'用户不存在','status'=>'error'];
                return $this->fetch('error'); // 渲染模板
                return json($data);
            }
            $info['sign'] = $params['sign'];
            session('_MEMBER',$info); 
        }
        

        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt($info['id']));
        }


        $me_trees_rank = [];
        $trees_rank = db('rank')->where('type','0')->order('green DESC')->select();

        foreach ($trees_rank as $key => $value) {
            if ($value['id']==$info['id']) {
                $me_trees_rank['name'] = $value['name'];
                $me_trees_rank['green'] = $value['green'];
                $me_trees_rank['rank'] = $key;
                $me_trees_rank['id'] = $info['id'];
            }
        }
        $this->assign('trees_rank', $trees_rank);
        $this->assign('me_trees_rank', $me_trees_rank);

        return $this->fetch(); // 渲染模板
    }

    public function team()
    {

        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt(session('_MEMBER')['id']));
        }
        $request = Request::instance();
        $params = $request->param();

        $member = session('_MEMBER');

        //个人
        $me_trees_rank = [];
        $trees_rank = db('rank')->where('type','0')->order('green DESC')->select();

        foreach ($trees_rank as $key => $value) {
            if ($value['id']==$member['id']) {
                $me_trees_rank['name'] = $value['name'];
                $me_trees_rank['green'] = $value['green'];
                $me_trees_rank['rank'] = $key;
                $me_trees_rank['id'] = $member['id'];
            }
        }
        $this->assign('trees_rank', $trees_rank);
        $this->assign('me_trees_rank', $me_trees_rank);
        
        //团队
        $trees_team_rank = db('rank')->where('type','1')->order('green DESC')->select();
        $this->assign('trees_team_rank', $trees_team_rank);
        
        return $this->fetch(); // 渲染模板
    }

}
