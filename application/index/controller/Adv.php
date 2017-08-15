<?php


namespace app\index\controller;
use \think\Request;
/**
 * 控制器
 * @package app\index\controller
 */
class Adv extends Home
{
     /**
     * 获取入口目录

     */
    protected function _initialize() {
        $base_file = $this->request->baseFile();
        $base_dir  = rtrim($base_file, 'index.php');
        $this->assign('static_dir', $base_dir. 'public/static/');
    }      

    public function index()
    {
        $info = db('announcement')->where('adv_status','1')->select();
        $adv = [];
        $in = [];
        foreach ($info as $key => $value) {
            if ($value['adv_type']=='0') {
                array_push($adv, $value);
            }else{
                array_push($in, $value);
            }
        }
        $this->assign('adv', $adv);
        $this->assign('in', $in);
        return $this->fetch(); // 渲染模板
    }

    public function detail()
    {
        $request = Request::instance();
        $params = $request->param();
        $info = db('announcement')->where('id',$params['id'])->find();
        $info['type'] = $info['adv_type']=='0'?'游戏公告':'游戏介绍';
        $this->assign('info', $info);
        return $this->fetch(); // 渲染模板
    }

}