<?php

namespace app\index\controller;

use \think\Request;
use \think\Db;

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

            $advmap['adv_status'] = 1;
            $advmap['adv_type'] = 0;
            $adv = db('announcement')->where($advmap)->find();
            if ($adv) {
                $adv['type'] = '游戏介绍';
            }
            $this->assign('adv', $adv);

        if (!$params||!isset($params['uid'])) {
            
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
            return $this->fetch('error'); // 渲染模板
            $data = ['msg'=>'用户不存在','status'=>'error'];
            return json($data);
        }
        $info['sign'] = $params['sign'];
        session('_MEMBER',$info);

        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt($info['id']));
        }

        //初始化一棵树苗
        $tree = db('trees')->where('user_id',$info['id'])->find();
        if (!$tree) {
            $data['user_id'] = $info['id'];
            $data['create_time'] = time();
            db('trees')->insert($data);
        }
        $this->redirect('index/index');

        return $this->fetch(); // 渲染模板

    }
    public function index()
    {   
        //取用户
        $member = session('_MEMBER');

        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt($member['id']));
        }

        //当前树苗阶段 3 或 <3
        $map['user_id'] = $member['id'];
        $map['status'] = array('lt',3);
        $tree = db('trees')->where($map)->find();
        
        //果实
        if ($tree) {
            $furitMap['trees_id'] = $tree['id'];
            $furitMap['status'] = 0;
            $furit = db('furit')->where($furitMap)->select();
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

        //lunbo
        $lunboMap['adv_status'] = '1';
        $lunbo = db('announcement')->field('id,adv_type,adv_title,adv_status,create_time')->where($lunboMap)->select();
        
        
        //互动提示
        // $tips = array(
        //     '1'=>'使用道具可使用树苗成长哦',
        //     '2'=>'灾害要来啦，快购买护盾，预防灾害吧',
        //     '3'=>'绿值不够兑换小树苗，快去参与绿色出行吧'
        // );
        // //获得当前树状态
        $tips_adv = [];
        $disaster = [];
        // if ($tree) {
        //     if ($tree['level']==1) {
        //         array_push($tips_adv, $tips[1]);
        //     }
        //     if ($tree['level']==2) {
        //         if ($tree['disaster']==1&&$tree['is_show']==0) {
        //             // $disaster['disaster_id'] = 1;
        //             // $disaster['id'] = 1;
        //             // $disaster['disaster_type'] = rand(0,2);
        //             // $disaster['disaster_value'] = null;
        //             // $disaster['start_time'] = time()+200;
        //             // $disaster['mdate'] = __mdate($disaster['start_time']);
        //             // $ts['is_show'] = 1; 
        //             // db('trees')->where('id',$tree['id'])->update($ts);
        //             array_push($tips_adv, $tips[2]);
        //         }
        //     }
        // }else{
        //      array_push($tips_adv, $tips[3]);
        // }
        $this->assign('tips_adv', $tips_adv);
        // 
        
        //灾害
        $disasterArr = array('台风','洪水','干旱');
        $now = time();
        $disasterMap['push_flish_time'] = array('lt',$now);
        $disasterMap['start_time'] = array('gt',$now);
        $disaster1 = db('disaster')->where($disasterMap)->order('id DESC')->select();
        foreach ($disaster1 as $key => $value) {
            $disaster1[$key]['adv_type'] = 0;
            $disaster1[$key]['adv_title'] = date('Y年m月d日 H:i',$value['start_time']).'将会有强烈'.$disasterArr[$value['disaster_type']].'来袭，请做好防护措施，护盾会自动弹出，能有效抵抗台风，保证树的安全！';
            $disaster1[$key]['create_time'] = $value['push_flish_time'];
        }
        if ($disaster1) {
            $lunbo = array_merge_recursive($lunbo,$disaster1);
        }
        

        // print_r($lunbo);exit;
        // $disaster = db('adv_disaster')->order('id DESC')->find();
        // $disaster['start_time'] = $disaster['start_time'];
        // $disaster['mdate'] = __mdate($disaster['start_time']);
        $this->assign('disaster', $disaster); 

        $this->assign('lunbo', $lunbo); 
        //个人排名
        $me_rank = [];
        $me_passenger_rank  = [];
        $me_driver_rank  = [];
        $person_rank = db('rank')->field('name as username,green as green_max,user_id as id')->where('type','0')->order('green DESC')->select();
        $driver_rank = db('rank')->field('name as username,green as green_max,user_id as id')->where('type','1')->order('green DESC')->select();


        // $person_rank = db('member')->field('username,green_max,id')->where('type','0')->order('green_max DESC')->limit('100')->select();
        // $driver_rank = db('member')->field('username,green_max,id')->where('type','1')->order('green_max DESC')->limit('100')->select();
        // if ($member['type']==1) {
            foreach ($driver_rank as $key => $value) {
                if ($value['id']==$member['id']) {
                    $me_driver_rank['name'] = $value['username'];
                    $me_driver_rank['green_max'] = $value['green_max'];
                    $me_driver_rank['rank'] = $key;
                    $me_driver_rank['id'] = $member['id'];
                }
            }
        // }else{
            foreach ($person_rank as $key => $value) {
                if ($value['id']==$member['id']) {
                    $me_passenger_rank['name'] = $value['username'];
                    $me_passenger_rank['green_max'] = $value['green_max'];
                    $me_passenger_rank['rank'] = $key;
                    $me_passenger_rank['id'] = $member['id'];
                }
            }
        // }
        //植树
        $me_trees_rank = [];
        $trees_rank = db('rank')->field('name as username,green as green_max,user_id as id')->where('type','0')->order('green DESC')->select();

        foreach ($trees_rank as $key => $value) {
            if ($value['id']==$member['id']) {
                $me_trees_rank['name'] = $value['username'];
                $me_trees_rank['green_max'] = $value['green_max'];
                $me_trees_rank['rank'] = $key;
                $me_trees_rank['id'] = $member['id'];
            }
        }
        //寻访
        $me_vie_rank = [];
        $vie_rank = db('rank')->field('name as username,green as green_max,user_id as id')->where('type','3')->order('green DESC')->select();
        foreach ($vie_rank as $key => $value) {
            if ($value['id']==$member['id']) {
                $me_vie_rank['name'] = $value['username'];
                $me_vie_rank['green_max'] = $value['green_max'];
                $me_vie_rank['rank'] = $key;
                $me_vie_rank['id'] = $member['id'];
            }
        }
        //班组排名
        $class_rank = db('rank')->field('name as class,green as max')->where('type','4')->order('green DESC')->select();
        //绿色出行
        $green_rank = db('rank')->field('name as class,green as max')->where('type','5')->order('green DESC')->select();
        // $class_rank = db('member')->field('class,sum(green_max) as max')->order('sum(green_max) DESC')->group('class_no')->limit('100')->select();
        //企业排名
        $company_rank = db('rank')->field('name as company,green as max')->where('type','6')->order('green DESC')->select();
        // $company_rank = db('member')->field('company,sum(green_max) as max')->order('sum(green_max) DESC')->group('company_no')->limit('100')->select();
        //地区排名
        $area_rank = db('rank')->field('name as area,green as max')->where('type','7')->order('green DESC')->select();
        $industry_rank = db('rank')->field('name as area,green as max')->where('type','8')->order('green DESC')->select();
        // $area_rank = db('member')->field('area,sum(green_max) as max')->order('sum(green_max) DESC')->group('area')->limit('100')->select();
        $this->assign('_MEMBER', $member);
        $this->assign('me_rank', $me_rank);
        $this->assign('person_rank', $person_rank);
        $this->assign('driver_rank', $driver_rank);
        $this->assign('class_rank', $class_rank);
        $this->assign('me_passenger_rank', $me_passenger_rank);
        $this->assign('me_driver_rank', $me_driver_rank);
        $this->assign('me_trees_rank', $me_trees_rank);
        $this->assign('me_vie_rank', $me_vie_rank);
        $this->assign('company_rank', $company_rank);
        $this->assign('trees_rank', $trees_rank);
        $this->assign('vie_rank', $vie_rank);
        $this->assign('green_rank', $green_rank);
        $this->assign('industry_rank', $industry_rank);
        $this->assign('area_rank', $area_rank);

        return $this->fetch(); // 渲染模板
    }
    public function disaster(){

        //取用户
        $member = session('_MEMBER');

        $request = Request::instance();
        $params = $request->param();
        $ts['is_show'] = 1; 
        $trees_id = $this->_currentTree()['id'];
        if ($trees_id) {
            db('trees')->where('id',$trees_id)->update($ts);
            $data = ['status'=>'succ','msg'=>'成功'];
            return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
        }else{
            $data = ['status'=>'error','msg'=>'服务器错误'];
            return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
        }
        

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
        $propMap['status'] = 0;
        $prop = db('my_prop')->where($propMap)->find();
        
        if ($prop) {
            //是否今日已用
            $propSetting = db('prop')->where('position',$prop_type)->find();
            $findMap['user_id'] = $member['id'];
            $findMap['prop_type'] = $prop_type;
            $findMap['status'] = 1;
            $findMap['trees_id'] = $this->_currentTree()['id'];
            $propTd = db('my_prop')->field('count(*) as count')->where($findMap)->find();
            // if ($propSetting&&$propTd&&($propTd['count']>=$propSetting['use_limit'])) {
            //     $data = ['status'=>'error','msg'=>'不能超过道具今日使用限制'];
            //     return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            // }
            //调整只能使用一次
            if ($propTd['count']) {
                $data = ['status'=>'error','msg'=>'不能超过道具使用限制，每个树苗只能使用一次道具哦'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
            $data['status'] = 1;
            $trees_id = $this->_currentTree()['id'];
            if (!$trees_id) {
                $data = ['status'=>'error','msg'=>'服务器错误'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
            $data['trees_id'] = $trees_id;
            $data['create_time'] = time();
            if(db('my_prop')->where('id',$prop['id'])->update($data)){
                
                $data = ['status'=>'succ','msg'=>'成功'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }else{
                $data = ['status'=>'error','msg'=>'道具不在存或已使用'];
                return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
        }else{
            $data = ['status'=>'error','msg'=>'道具不在存或已使用'];
            return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            
        }
        
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
            //果实
            if ($tree) {
                $furitMap['trees_id'] = $tree['id'];
                $furitMap['status'] = 0;
                $furit = db('furit')->where('trees_id',$tree['id'])->select();
                $tree['furit'] = $furit;
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
        if ($prop&&($growCoin>=$prop['cash'])) {
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
        $furitmap['trees_id']  = $trees_id;
        $furitmap['status']  = 0;
        $furit = db('furit')->where($furitmap)->find();
        $map['id']  = $furit['id'];
        $data['status']  = 1;
        db('furit')->where($map)->update($data);
        $reward = $this->_rewardSetting();
        if ($type==1) {
            $green = rand($reward['green_limit'],$reward['green_max']);
            $save['user_id'] = $member['id'];
            $save['green'] = $green;
            $save['create_time'] = time();

            if(db('green_record')->insert($save)){
                //查询是否已领取完 自动兑换小树苗
                $furitMap['id'] = $furit['id'];
                $furitMap['status'] = 0;
                if (!db('furit')->where($furitMap)->find()) {
                    $this->__handleTrees();
                }
                
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
               //查询是否已领取完 自动兑换小树苗
                $furitMap['id'] = $furit['id'];
                $furitMap['status'] = 0;
                if (!db('furit')->where($furitMap)->find()) {
                    $this->__handleTrees();
                }
               $data = ['status'=>'succ','msg'=>'获得优惠券'.$conpon_name]; 
               return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
            }
        }
        
        
    }
    
    public function getaward(){
        //取用户
        $member = session('_MEMBER');
        $c_member = db('member')->where('id',$member['id'])->find();
        $request = Request::instance();
        $params = $request->param();
        if ($params&&$params['id']) {
            //
            $map['task_id'] = $params['id'];
            $map['user_id'] = $member['id'];
            if(db('task')->where('id',$params['id'])->find()&&!db('task_process')->where($map)->find()){
                
                //更新
                $insert['task_id'] = $params['id'];
                $insert['user_id'] = $member['id'];
                $insert['status'] = 1; 
                $insert['create_time'] = time(); 
                db('task_process')->insert($insert);
                //获得奖励
                $green = db('task_recode')->field('sum(green) as total')->find();
                //更新用户绿值
                $save['green_nocash'] = array('exp', 'green_nocash+'.$green['total']);
                $save['green_max'] = array('exp', 'green_max+'.$green['total']);
                
                $res = db('member')->where('id',$member['id'])->update($save);

                if ($res) {
                    $data = ['status'=>'succ','msg'=>'领取成功']; 
                }
                
            }else{
               $data = ['status'=>'error','msg'=>'已领取过了']; 
            }
            
            return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
        }else{
            $data = ['status'=>'error','msg'=>'参数必填'];
            return json(['data'=>$data,'code'=>1,'message'=>'获得成功']);
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

    function __handleTrees(){
        $member = session('_MEMBER');
        $delvop = $this->_maxLiveTree();
        $data['user_id'] = $member['id'];
        if ($delvop['cash_trees']<=$member['green']) {
           if(db('trees')->insert($data)){
                $save['green'] = array('exp', 'green-'.$delvop['cash_trees']);
                $save['green_max'] = array('exp', 'green_max-'.$delvop['cash_trees']);
                
                $res = db('member')->where('id',$member['id'])->update($save);
                if ($res) {
                    $s['user_id'] = $member['id'];
                    $s['green'] = $delvop['cash_trees'];
                    $s['create_time'] = time();
                    $s['type'] = 1;
                    db('green_record')->insert($s);
                    $info = db('member')->where('id',$member['id'])->find();
                    session('_MEMBER',$info);
                }
           } 
        }
        
    }
    // function _hanldTree($tree){
    //     if (!$tree) {
    //         return null;
    //     }
    //     $member = session('_MEMBER');
    //     $lives = $tree['lifes'];
    //     $maxLives = $this->_maxLiveTree();
    //     $average = $maxLives/5;
    //     switch ($lives) {
    //         case $lives>=$average*0 && $score<=$average*1:
    //             $level = 1;
    //             break;
    //         case $lives>=$average*1 && $score<=$average*2:
    //             $level = 2;
    //             //更新
    //             $treesMap['id'] = $tree['id'];
    //             $treesMap['level'] = 2;
    //             if (!db('trees')->where($treesMap)->find()) {
    //                 $data['level'] = 2;
    //                 db('trees')->where('id',$tree['id'])->update($data);  
    //             }
    //             break;
    //         case $lives>=$average*2 && $score<=$average*3:
    //             $level = 3;
    //             //更新
    //             $treesMap['id'] = $tree['id'];
    //             $treesMap['level'] = 3;
    //             if (!db('trees')->where($treesMap)->find()) {
    //                 $data['level'] = 3;
    //                 db('trees')->where('id',$tree['id'])->update($data);  
    //             }
    //             //判断是不是要结果了
    //             $propMap['trees_id'] = $tree['id'];
    //             $propMap['status'] = 0;
    //             $prop_use = db('my_prop')->where($propMap)->select($data); 
    //             $prop_type = array_column($prop_use, 'prop_type');
    //             if (array_unique($prop_type)==3) {
    //                 $treesMap['id'] = $tree['id'];
    //                 $udata['status'] = 2;
    //                 db('trees')->where($treesMap)->update($udata);
    //             }else{
    //                 $treesMap['id'] = $tree['id'];
    //                 $udata['status'] = 1;
    //                 db('trees')->where($treesMap)->update($udata);
    //             }
    //             break;    
    //         default:
    //             # code...
    //             break;
    //     }
    //     return db('trees')->where('id',$tree['id'])->find();
    // }

}
