<?php
namespace tasks\syncwxsport;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class syncwxsportTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

      Utils::dbConfig(Utils::config('DB','syncwxsport'));

      //dis
      $sql3 = 'delete from game_wxsport_temp';
      Utils::model("wxsport_temp")->execute($sql3);
      //update
      $sql4 = 'select b.* from game_wxsport b left join game_member a on b.LoginId = a.sign  where  unix_timestamp(b.updatetime)>a.create_time';
      $res = Utils::model("wxsport")->execute($sql4);
      if ($res) {
        Utils::model("wxsport_temp")->addAll($res,array(),true);
      }
      
      //兑换成长币
      $develop = Utils::model("develop")->find();
	    //取步数 步数换算绿值 答题数换算成长币
        $sql = 'update game_member a 
inner join (select Step,AccuracyNum,AddTime,LoginId,updatetime from game_wxsport_temp WHERE 1 ) b on a.sign = b.LoginId  
set a.steps = CASE b.Step
            WHEN b.Step>10000 THEN 10000+a.steps
            WHEN b.Step<10000 THEN b.Step+a.steps
        END,a.green_max = CASE b.Step
            WHEN b.Step>10000 THEN ceil(10000*0.6*2/1000)+a.green_max
            WHEN b.Step<10000 THEN ceil(b.Step*0.6*2/1000)+a.green_max
        END,a.green = CASE b.Step
            WHEN b.Step>10000 THEN ceil(10000*0.6*2/1000)+a.green
            WHEN b.Step<10000 THEN ceil(b.Step*0.6*2/1000)+a.green
        END,a.share = ceil(b.AccuracyNum*'.intval($develop['cash_share']).')+a.share where 1 ';

        Utils::model("member")->execute($sql);
        
        //update time
        $sql1 = 'update game_member set create_time = NOW() where 1';
        Utils::model("member")->execute($sql1);

		flush();
	}
}
