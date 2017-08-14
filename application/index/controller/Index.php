<?php

namespace app\index\controller;

use \think\Request;

use app\user\model\Member as MemberModel;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Index extends Home
{

    public function launch()
    {
        //获得当前登录用户
        $request = Request::instance();
        $params = $request->param();
        if (!$params||!$params['sign']) {
            session('_MEMBER',null);//每次启动游戏检测用户标识 不存在去本地session
            $data = ['msg'=>'用户sign丢失','status'=>'error'];
            return json($data);
        }
        //获取用户信息
        $info = db('member')->where('sign',$params['sign'])->find();
        if (!$info) {
            session('_MEMBER',null);//
            $data = ['msg'=>'用户不存在','status'=>'error'];
            return json($data);
        }
        
        session('_MEMBER',$info);

        //初始化一棵树苗
        $tree = db('trees')->where('user_id',$info['id'])->find();
        if (!$tree) {
            $data['user_id'] = $info['id'];
            $data['create_time'] = time();
            db('trees')->insert($data);
        }
        // $this->redirect('index/index');

        return $this->fetch(); // 渲染模板

    }
    public function index()
    {
        //取用户
        $member = session('_MEMBER');

        //当前树苗阶段 3 或 <3
        $map['user_id'] = $member['id'];
        $map['status'] = array('lt',3);
        $tree = db('trees')->where($map)->find();
        $this->assign('tree', $tree);
        $count = db('trees')->where('user_id',$member['id'])->count();
        $this->assign('count', $count);

        //灾害
        $now = time();
        $disasterMap['start_time'] = array('lt',$now);
        $disasterMap['end_time'] = array('gt',$now);
        $disaster = db('disaster')->where($disasterMap)->find();
        $this->assign('disaster', $disaster);  

        //道具
        $waterMap['user_id'] = $member['id'];
        $waterMap['status'] = '0';
        $waterMap['prop_type'] = '1';
        $waterprop = db('my_prop')->where($waterMap)->count();
        $this->assign('waterprop', $waterprop);

        $cutMap['user_id'] = $member['id'];
        $cutMap['status'] = '0';
        $cutMap['prop_type'] = '2';
        $cutprop = db('my_prop')->where($cutMap)->count();
        $this->assign('cutprop', $cutprop);

        $shifeiMap['user_id'] = $member['id'];
        $shifeiMap['status'] = '0';
        $shifeiMap['prop_type'] = '3';
        $shifeiprop = db('my_prop')->where($shifeiMap)->count();
        $this->assign('shifeiprop', $shifeiprop);

        $hudunMap['user_id'] = $member['id'];
        $hudunMap['status'] = '0';
        $hudunMap['prop_type'] = '4';
        $hudunprop = db('my_prop')->where($hudunMap)->count();
        $this->assign('hudunprop', $hudunprop);
        //个人排名
        $me_rank = [];
        $person_rank = db('member')->field('username,green_max,id')->where('type','0')->order('green_max DESC')->limit('100')->select();
        $driver_rank = db('member')->field('username,green_max,id')->where('type','1')->order('green_max DESC')->limit('100')->select();
        if ($member['type']==1) {
            foreach ($driver_rank as $key => $value) {
                if ($value['id']==$member['id']) {
                    $me_rank['name'] = $value['username'];
                    $me_rank['green_max'] = $value['green_max'];
                    $me_rank['rank'] = $key;
                }
            }
        }else{
            foreach ($person_rank as $key => $value) {
                if ($value['id']==$member['id']) {
                    $me_rank['name'] = $value['username'];
                    $me_rank['green_max'] = $value['green_max'];
                    $me_rank['rank'] = $key;
                }
            }
        }
        //班组排名
        $class_rank = db('member')->field('class,sum(green_max) as max')->order('sum(green_max) DESC')->group('class_no')->limit('100')->select();
        //企业排名
        $company_rank = db('member')->field('company,sum(green_max) as max')->order('sum(green_max) DESC')->group('company_no')->limit('100')->select();
        //地区排名
        $area_rank = db('member')->field('area,sum(green_max) as max')->order('sum(green_max) DESC')->group('area')->limit('100')->select();
        $this->assign('_MEMBER', $member);
        $this->assign('me_rank', $me_rank);
        $this->assign('person_rank', $person_rank);
        $this->assign('driver_rank', $driver_rank);
        $this->assign('class_rank', $class_rank);
        $this->assign('company_rank', $company_rank);
        $this->assign('area_rank', $area_rank);

        return $this->fetch(); // 渲染模板
    }

    public function prop()
    {
        //取用户
        $member = session('_MEMBER');

        $request = Request::instance();
        $params = $request->param();

        //当前用户 | 道具 
        $prop_type = (int)$params['prop_type'];
        $propMap['user_id'] = $member['id'];
        $propMap['prop_type'] = $prop_type;

        if (db('my_prop')->where($propMap)->find()) {
            $data['status'] = 1;
            if(db('my_prop')->where($propMap)->update($data)){
                $data = ['status'=>'succ','msg'=>'成功'];
            }else{
                $data = ['status'=>'error','msg'=>'道具不在存或已使用'];
            }
        }else{
            $data = ['status'=>'error','msg'=>'道具不在存或已使用'];
            
        }
        return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
    }

    public function level()
    {
        //取用户
        $member = session('_MEMBER');

        $request = Request::instance();
        $params = $request->param();


        //当前树苗阶段 3 或 <3
        $map['user_id'] = $member['id'];
        $map['status'] = array('lt',3);

        if (db('trees')->where($map)->find()) {
            $tree = db('trees')->where($map)->find();
            $data = ['status'=>'succ','msg'=>'','list'=>$tree];
        }else{
            $data = ['status'=>'error','msg'=>'服务器错误'];
            
        }
        return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
    }

}
