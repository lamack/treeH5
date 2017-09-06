<?php
namespace tasks\wxsport;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
use core\lib\db\Driver;
/**
 * 测试任务 
 */
class wxsportTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
  public function run(){

      // $db_config = Utils::dbConfig(Utils::config('DB','login'));
     //  $db = Utils::db($db_config);
        
       

      $res = Utils::model("wxsport",'','mysql://root:Tripshare2017@rm-bp1c7jlz0045ph079o.mysql.rds.aliyuncs.com:3366/trees#utf8')->select();
       Utils::Log($res);
      // //切换数据库
      // if ($res) {
      //     Utils::model("wxsport",'game_','mysql://root:@127.0.0.1:3306/dolphin#utf8')->addAll($res,array(),true);
      // }
      
      flush();
  }
}
