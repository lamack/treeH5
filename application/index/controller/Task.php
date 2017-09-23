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
        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt(session('_MEMBER')['id']));
        }
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
            $is = 0;
            //特殊任务处理
            if ($value['type']>0) {
                switch ($value['type']) {
                    case '1':
                        $sm['user_id'] = $member['id'];
                        $sm['sign'] = 1;
                        $is = db('green_record')->where($sm)->count();
                        break;
                    case '2':
                        $sm['user_id'] = $member['id'];
                        $sm['sign'] = 2;
                        $is = db('green_record')->where($sm)->count();
                        break;
                    case '3':
                        $sm['user_id'] = $member['id'];
                        $sm['sign'] = 3;
                        $is = db('green_record')->where($sm)->count();
                        break;
                    case '4':
                        $sm['user_id'] = $member['id'];
                        $sm['sign'] = 4;
                        $is = db('green_record')->where($sm)->count();
                        break;               
                    
                    default:
                        # code...
                        break;
                }
            }
            if ($is>0) {
                $info[$key]['status'] =2;
            }
        }
        
        $this->assign('task', $info);
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
                if (isset($task[$value['id']])) {
                    $info[$key]['status'] = 2;
                }
               
            }
        }
        
        return $info;
    }



}
