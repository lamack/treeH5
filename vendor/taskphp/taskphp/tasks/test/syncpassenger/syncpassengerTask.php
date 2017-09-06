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

        //取总量程
        $sql = 'update game_member a 
inner join (select sum(MILES) as total,PHONE,CREATE_DATETIME from game_passenger_trip WHERE TO_DAYS(CREATE_DATETIME)=TO_DAYS(NOW()) ) b on a.contact = b.PHONE  
set a.mileage = CASE b.total
            WHEN b.total>20 THEN 20
            WHEN b.total<20 THEN b.total
        END,a.green_max = CASE b.total
            WHEN b.total>40 THEN 40+a.green_max
            WHEN b.total<40 THEN ceil(b.total)+a.green_max
        END,a.green = CASE b.total
            WHEN b.total>40 THEN 40+a.green
            WHEN b.total<40 THEN ceil(b.total)+a.green
        END,create_time = NOW() where TO_DAYS(a.create_time)<>TO_DAYS(NOW())';
      
        Utils::model("member")->execute($sql);

		flush();
	}
}
