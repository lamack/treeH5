<?php
namespace tasks\syncuserinfo;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class syncuserinfoTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){
      Utils::dbConfig(Utils::config('DB','syncuserinfo'));
	    //duplicate sign update
      // $sql = 'replace into game_member (username,company,class,contact,sign,class_no,company_no,industry,industry_no) SELECT user_name,company,team_name,phone,uid,team_code,company,county,county FROM game_user_info a where not exists(select * from game_member where TO_DAYS(a.update_time) = TO_DAYS(NOW()) AND a.uid = game_member.sign )';
      $sql = 'replace into game_member (username,company,class,contact,sign,class_no,company_no,industry,industry_no) 
SELECT user_name,company,team_name,phone,uid,team_code,company,county,county FROM game_user_info a 
where not exists(select * from game_member where contact = a.phone ) ';
      Utils::model("member")->execute($sql);
      
		  flush();
	}
}
