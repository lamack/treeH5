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
                //获得中间库用户信息
                $db = Db::connect('mysql://root:Tripshare2017@rm-bp1c7jlz0045ph079o.mysql.rds.aliyuncs.com:3366/sgs_bzds#utf8');//正式
                // $db = Db::connect('mysql://root:Innketek201306@139.196.20.81:3306/dolphin#utf8');
                //$res = $db->name('game_user_info')->where('uid',$params['uid'])->find();
                $res = $db->name('user_info')->where('uid',$params['uid'])->find();

                if ($res) {
                    $data['username'] = $res['user_name'];
                    $data['sign'] = $res['uid'];
                    $data['contact'] = $res['phone'];
                    $data['class_no'] = $res['team_code'];
                    $data['class'] = $res['team_name'];
                    $data['company'] = $res['company'];
                    $data['company_no'] = $res['company'];
                    $data['area'] = $res['county'];
                    $data['trees'] = 1;
                    db('member')->insert($data);

                    $this ->redirect('index/launch',array('uid' => $params['uid'],'sign' => $params['sign']),1, '会员同步登录中...');
                }
                $data = ['msg'=>'用户不存在','status'=>'error'];
                return $this->fetch('error1'); // 渲染模板
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
        $trees_rank = db('rank')->where('type','0')->order('id ASC')->limit(100)->select();

        foreach ($trees_rank as $key => $value) {
            if ($value['user_id']==$info['id']) {
                $me_trees_rank['name'] = $value['name'];
                $me_trees_rank['green'] = $value['green'];
                $me_trees_rank['rank'] = $key+1;
                $me_trees_rank['id'] = $info['id'];
                // unset($trees_rank[$key]);
            }
        }
        // print_r($info);exit;
        $this->assign('trees_rank', $trees_rank);
        $this->assign('member', $info);
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
