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

}
