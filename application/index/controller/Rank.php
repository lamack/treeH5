<?php


namespace app\index\controller;
use \think\Request;
/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Rank extends Home
{
          

    public function index()
    {
        $member = session('_MEMBER');
        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt(session('_MEMBER')['id']));
        }
        
        //植树
        $me_trees_rank = [];
        $trees_rank = db('rank')->where('type','0')->order('id DESC')->limit(100)->select();
        foreach ($trees_rank as $key => $value) {
            if ($value['user_id']==$member['id']) {
                $me_trees_rank['name'] = $value['name'];
                $me_trees_rank['green'] = $value['green'];
                $me_trees_rank['rank'] = $key+1;
                $me_trees_rank['user_id'] = $member['id'];
                // unset($trees_rank[$key]);
            }
        }
        // $trees_rank = array_values($trees_rank);
        // print_r($trees_rank);exit;
        $this->assign('trees_rank', $trees_rank);
        $this->assign('member', $member);
        $this->assign('me_trees_rank', $me_trees_rank);
        return $this->fetch(); // 渲染模板
    }

    



}
