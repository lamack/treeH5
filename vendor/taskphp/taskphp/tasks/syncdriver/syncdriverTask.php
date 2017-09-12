<?php
namespace tasks\syncdriver;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class syncdriverTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

      Utils::dbConfig(Utils::config('DB','syncdriver'));

      //dis
      $sql3 = 'delete from game_driver_temp';
      Utils::model("driver_temp")->execute($sql3);
      $sql5 = 'delete from game_driver_total';
      Utils::model("driver_total")->execute($sql5);
      //update
      $sql4 = 'insert into game_driver_temp (select b.* from game_driver_trip b left join game_member a on b.PHONE = a.contact  where  unix_timestamp(b.END_DATETIME)>a.passenger_time)';
      Utils::model("driver_temp")->execute($sql4);
      
      //总计
      $sql5 = 'insert into game_driver_total (MILES,PHONE) select sum(MILES) as MILES,PHONE from game_driver_temp where 1 group by PHONE';
      Utils::model("driver_total")->execute($sql5);

	    //取总量程
        $sql = 'update game_member a 
inner join  game_driver_total  b on a.contact = b.PHONE  
set a.driver_mileage = b.MILES,a.green_max = ceil(b.MILES)+a.green_max,a.green = ceil(b.MILES)+a.green where 1';

       
      
        Utils::model("member")->execute($sql);
        
        //同步时间
        //update time
        $sql1 = 'update game_member set driver_time = unix_timestamp() where 1';
        Utils::model("member")->execute($sql1);
        
		flush();
	}
}
