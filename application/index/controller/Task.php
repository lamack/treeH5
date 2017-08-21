<?php


namespace app\index\controller;
use \think\Request;
/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Task extends Home
{
          

    public function index()
    {
        $member = session('_MEMBER');
// print_r(db('task')->Query('select * from game_task'));exit;
        //全局任务
        $info = db('task')->select();
        if ($info) {
            $info = $this->task_process($info,$member['id']);
        }
        //任务完成记录
        $recode = db('task_recode')->where('mobile',$member['contact'])->select();
        $task=[];
        foreach ($recode as $key => $value) {
            $task[$value['task_id']][$key] = $value;
        }
        //获得任务完成进度 绿值 | 状态
        
        foreach ($info as $key => $value) {
            if (isset($task[$value['id']])) {
                if (isset($value['status'])) {
                    $info[$key]['status'] = $value['status']==2?2:1;
                }else{
                    $info[$key]['status'] =1;
                }
                
                $info[$key]['task_introduce'] = $this->_get_task_introduce($task[$value['id']]);
            }else{
                if (isset($value['status'])) {
                    $info[$key]['status'] = $value['status']==2?2:0;
                }else{
                    $info[$key]['status'] =0;
                }
                
            }
        }
        

        $this->assign('task', $info);
        return $this->fetch(); // 渲染模板
    }

    public function detail()
    {
        $request = Request::instance();
        $params = $request->param();
        $info = db('task')->where('id',$params['id'])->find();
        $this->assign('info', $info);
        return $this->fetch(); // 渲染模板
    }

    public function _get_task_introduce($task){
        $green = 0;
        foreach ($task as $key => $value) {
            $green +=$value['green']; 
        }
        return $green;
    }
    public function task_process($info,$uid){
        $data = [];
        $map['user_id'] = $uid;
        $list = db('task_process')->where($map)->select();
        $task=[];
        foreach ($list as $key => $value) {
            $task[$value['task_id']][$key] = $value;
        }
        if ($task) {
            foreach ($info as $key => $value) {
                if ($task[$value['id']]) {
                    $info[$key]['status'] = 2;
                }
               
            }
        }
        
        return $info;
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
                // db('task_process')->insert($insert);
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

}
