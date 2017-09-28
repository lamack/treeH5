<?php
namespace tasks\syncpassenger;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class syncpassengerTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

        Utils::dbConfig(Utils::config('DB','syncpassenger'));

      //dis
      $sql3 = 'delete from game_passenger_temp';
      Utils::model("passenger_temp")->execute($sql3);
      $sql5 = 'delete from game_passenger_total';
      Utils::model("passenger_total")->execute($sql5);
      //update
      $sql4 = 'insert into game_passenger_temp (select b.* from game_passenger_trip b left join game_member a on b.PHONE = a.contact  where  unix_timestamp(b.END_DATETIME)>a.passenger_time)  ';
      Utils::model("passenger_temp")->execute($sql4);
      
      //总计
      $sql5 = 'insert into game_passenger_total (MILES,PHONE) select  (CASE  WHEN sum(MILES)>20 THEN 20 ELSE sum(MILES)  END) as MILES ,PHONE from game_passenger_temp where 1 group by PHONE';
      Utils::model("passenger_total")->execute($sql5);

      //取总量程
        $sql = 'update game_member a 
inner join  game_passenger_total  b on a.contact = b.PHONE  
set a.mileage = (a.mileage+b.MILES),a.green_mileage = round(b.MILES)+a.green_mileage,passenger_time = unix_timestamp() where 1';
        Utils::model("member")->execute($sql);

        $sql = 'update game_member set green = green_mileage + green_steps - green_spent, green_max = green_mileage + green_steps + green_noc
ach';
        Utils::model("member")->execute($sql);
        
//         //取总量程
//         $sql = 'update game_member a 
// inner join  game_passenger_total  b on a.contact = b.PHONE  
// set a.mileage = (a.mileage+b.MILES),a.green_max = round(b.MILES)+a.green_max,a.green = round(b.MILES)+a.green,passenger_time = unix_timestamp() where 1';
      
//         Utils::model("member")->execute($sql);

         //update time
        // $sql1 = 'update game_member set passenger_time = unix_timestamp() where 1';
        // Utils::model("member")->execute($sql1);

		flush();
	}
}
