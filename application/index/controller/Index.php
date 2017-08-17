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
        
        //果实
        if ($tree) {
            $furit = db('furit')->where('trees_id',$tree['id'])->select();
            $tree['furit'] = $furit;
        }

        $this->assign('tree', $tree);
        $count = db('trees')->where('user_id',$member['id'])->count();
        $this->assign('count', $count);

        
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

        //灾害
        // $now = time();
        // $disasterMap['start_time'] = array('lt',$now);
        // $disasterMap['end_time'] = array('gt',$now);
        // $disaster = db('disaster')->where($disasterMap)->find();
        // $myDisasterMap['disaster_id'] = $disaster['id'];
        // $myDisasterMap['user_id'] = $member['id'];
        // if ($disaster&&db('prop_disaster')->where($myDisasterMap)->find()) {
        //     $disaster = array();//已经历过
        // }
        
        $disaster = db('adv_disaster')->order('id DESC')->find();
        $disaster['start_time'] = __mdate($disaster['start_time']);
        $this->assign('disaster', $disaster);  
        //个人排名
        $me_rank = [];

        $person_rank = db('rank')->field('name as username,green as green_max,user_id as id')->where('type','0')->order('green DESC')->select();
        $driver_rank = db('rank')->field('name as username,green as green_max,user_id as id')->where('type','1')->order('green DESC')->select();


        // $person_rank = db('member')->field('username,green_max,id')->where('type','0')->order('green_max DESC')->limit('100')->select();
        // $driver_rank = db('member')->field('username,green_max,id')->where('type','1')->order('green_max DESC')->limit('100')->select();
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
        $class_rank = db('rank')->field('name as class,green as max')->where('type','2')->order('green DESC')->select();
        // $class_rank = db('member')->field('class,sum(green_max) as max')->order('sum(green_max) DESC')->group('class_no')->limit('100')->select();
        //企业排名
        $company_rank = db('rank')->field('name as company,green as max')->where('type','3')->order('green DESC')->select();
        // $company_rank = db('member')->field('company,sum(green_max) as max')->order('sum(green_max) DESC')->group('company_no')->limit('100')->select();
        //地区排名
        $area_rank = db('rank')->field('name as area,green as max')->where('type','4')->order('green DESC')->select();
        // $area_rank = db('member')->field('area,sum(green_max) as max')->order('sum(green_max) DESC')->group('area')->limit('100')->select();
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
        $prop = db('my_prop')->where($propMap)->find();
        if ($prop) {
            $data['status'] = 1;
            $trees_id = $this->_currentTree()['id'];
            if (!$trees_id) {
                $data = ['status'=>'error','msg'=>'服务器错误'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
            $data['trees_id'] = $trees_id;
            if(db('my_prop')->where('id',$prop['id'])->update($data)){
                
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
        $develop = $this->_maxLiveTree();
        if (db('trees')->where($map)->find()) {
            $tree = db('trees')->where($map)->find();
            //处理结果
            if ($tree['status']<3) {
                $tree = $this->_hanldTree($tree);
            }
            $data = ['status'=>'succ','msg'=>'','list'=>$tree];
        }else{
            $data = ['status'=>'error','msg'=>'服务器错误'];
            
        }
        return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
    }
    //兑换道具
    public function cash()
    {
        //取用户
        $member = session('_MEMBER');
        $c_member = db('member')->where('id',$member['id'])->find();
        $request = Request::instance();
        $params = $request->param();

        //成长币
        $growCoin =  (int)$c_member['share'];
        //道具售价
        $prop_type = (int)$params['prop_type'];
        $map['position'] = $prop_type;
        $prop = db('prop')->where($map)->find();
        if ($prop&&($growCoin>$prop['cash'])) {
            $map1['id'] = $member['id'];
            if(db('member')->where($map1)->setDec('share',$prop['cash'])){
                $save['user_id'] = $member['id'];
                $save['create_time'] = time();
                $save['prop_type'] = $prop_type;
                db('my_prop')->insert($save);
                $data = ['status'=>'succ','msg'=>'','data'=>array('cash'=>$prop['cash'])];
            }else{
                $data = ['status'=>'error','msg'=>'服务器错误'];
            }
            //添加记录
            $save['user_id'] = $member['id'];
            $save['recode'] = '兑换道具，消耗成长币'.$prop['cash'];
            $save['create_time'] = time();
            db('growCoin')->insert($save);
            $c_member = db('member')->where('id',$member['id'])->find();
            session('_MEMBER',$c_member);
        }else{
            $data = ['status'=>'error','msg'=>'成长币不够，快去红色寻访吧'];
        }
        
        return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
    }
    //果实领取
    public function furit(){
        //取用户
        $member = session('_MEMBER');
        $request = Request::instance();
        $params = $request->param();

        $type = (int)$params['type'];//1为绿值
        $trees_id = $this->_currentTree()['id'];
        //更新状态
        $furit = db('furit')->where('trees_id',$trees_id)->find();
        $map['id']  = $furit['id'];
        $map['status']  = 0;
        db('furit')->where($map)->update($data);
        $reward = $this->_rewardSetting();
        if ($type==1) {
            $green = rand($reward['green_limit'],$reward['green_max']);
            $save['user_id'] = $member['id'];
            $save['green'] = $green;
            $save['create_time'] = time();

            if(db('green_record')->insert($save)){
                $data = ['status'=>'succ','msg'=>'获得绿值'.$green.'点'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }else{
                $data = ['status'=>'error','msg'=>'服务器错误'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
            
        }else{//抽取优惠券
            $prize_arr =array('a'=>30,'b'=>70);
            $res = __get_rand($prize_arr);
            if ($res=='a') {
               $data = ['status'=>'succ','msg'=>'果实是坏的没有抽到优惠券'];
               return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }else{
               //取一条没使用的优惠券
               $conpon =  db('conpon')->where('conpon_status','0')->find();
               if (!$conpon) {
                   $data = ['status'=>'error','msg'=>'果实是坏的没有抽到优惠券'];
                   return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
               }
               $save['user_id'] = $member['id'];
               $save['conpon_id'] = $conpon['id'];
               $save['create_time'] = time();
               db('recode')->insert($save);
               $conpon_name = get_conpon($conpon['id']);
               $data = ['status'=>'succ','msg'=>'获得优惠券'.$conpon_name]; 
               return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
        }
        
        
    }

    function _currentTree(){
        $member = session('_MEMBER');

        $map['user_id'] = $member['id'];
        $map['status'] = array('lt',3);

        $tree = db('trees')->where($map)->find();
        return $tree;
    }

    function _maxLiveTree(){

        $develop = db('develop')->find();
        return $develop;
    }

    function _rewardSetting(){

        $reward = db('reward_setting')->find();
        return $reward;
    }

    function _hanldTree($tree){
        if (!$tree) {
            return null;
        }
        $member = session('_MEMBER');
        $lives = $tree['lifes'];
        $maxLives = $this->_maxLiveTree();
        $average = $maxLives/5;
        switch ($lives) {
            case $lives>=$average*0 && $score<=$average*1:
                $level = 1;
                break;
            case $lives>=$average*1 && $score<=$average*2:
                $level = 2;
                //更新
                $treesMap['id'] = $tree['id'];
                $treesMap['level'] = 2;
                if (!db('trees')->where($treesMap)->find()) {
                    $data['level'] = 2;
                    db('trees')->where('id',$tree['id'])->update($data);  
                }
                break;
            case $lives>=$average*2 && $score<=$average*3:
                $level = 3;
                //更新
                $treesMap['id'] = $tree['id'];
                $treesMap['level'] = 3;
                if (!db('trees')->where($treesMap)->find()) {
                    $data['level'] = 3;
                    db('trees')->where('id',$tree['id'])->update($data);  
                }
                //判断是不是要结果了
                $propMap['trees_id'] = $tree['id'];
                $propMap['status'] = 0;
                $prop_use = db('my_prop')->where($propMap)->select($data); 
                $prop_type = array_column($prop_use, 'prop_type');
                if (array_unique($prop_type)==3) {
                    $treesMap['id'] = $tree['id'];
                    $udata['status'] = 2;
                    db('trees')->where($treesMap)->update($udata);
                }else{
                    $treesMap['id'] = $tree['id'];
                    $udata['status'] = 1;
                    db('trees')->where($treesMap)->update($udata);
                }
                break;    
            default:
                # code...
                break;
        }
        return db('trees')->where('id',$tree['id'])->find();
    }

}
