<?php


namespace app\index\controller;

use app\common\controller\Common;

use \think\Request;
/**
 * 前台公共控制器
 * @package app\index\controller
 */
class Home extends Common
{
    /**
     * 初始化方法

     */
    protected function _initialize()
    {
        // 系统开关
        if (!config('web_site_status')) {
            $this->error('站点已经关闭，请稍后访问~');
        }
        //资源目录
        $base_file = $this->request->baseFile();
        $base_dir  = rtrim($base_file, 'index.php');
        $this->assign('static_dir', $base_dir. 'public/static/');
        
        //处理分享出去链接
        $request = Request::instance();
        $params = $request->param();

        // session('_MEMBER',null);
        $member = session('_MEMBER');
        
        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt($member['id']));
        }
        
        if (!$member&&$params&&isset($params['token'])) {

            $this->redirect('share/index',array('token'=>$params['token']));
        }
        
    }
}
