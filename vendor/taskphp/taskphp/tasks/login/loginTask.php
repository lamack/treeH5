<?php
namespace tasks\login;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class loginTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){


      $res = Utils::model("login",'user_','mysql://root:Tripshare2017@rm-bp1c7jlz0045ph079o.mysql.rds.aliyuncs.com:3366/tripshare#utf8')->select();
      // //切换数据库
      if ($res) {
          Utils::model("user_login",'game_','mysql://root:Tripshare2017@rm-bp1c7jlz0045ph079o.mysql.rds.aliyuncs.com:3366/trees#utf8')->addAll($res,array(),true);
      }
      
		  flush();
	}
}
