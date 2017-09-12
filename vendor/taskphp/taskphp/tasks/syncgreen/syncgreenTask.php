<?php
namespace tasks\syncgreen;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class syncgreenTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

	    Utils::dbConfig(Utils::config('DB','syncgreen'));

        //注册了申工社APP
        if (Utils::model("task")->where('type',1)->find()) {
//             $sql1 = 'update game_member a 
// inner join (select uid, COUNT(uid) as cout,phone from game_user_info ) b on a.contact = b.phone 
// set a.green_nocash = a.green_nocash+38 , green_max = a.green_max+38 
// where NOT EXISTS (select user_id from game_green_record where sign=1 and a.id = user_id ) and b.cout>0';
            $sql1 = 'update game_member a 
inner join game_user_info b on a.contact = b.phone 
set a.green_nocash = a.green_nocash+38 , green_max = a.green_max+38 
where NOT EXISTS (select user_id from game_green_record where sign=1 and a.id = user_id ) and b.uid is not null';
            if(Utils::model("member")->execute($sql1)){
                $sql2 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,38,NOW(),1 FROM game_member a 
where not exists(select * from game_green_record where sign = 1 and a.id = user_id)';
                Utils::model("green_record")->execute($sql2);
            } 
        }

        //绑定“申工社”APP
        if (Utils::model("task")->where('type',2)->find()) {
//             $sql3 = 'update game_member a 
// inner join (select uid, COUNT(uid) as cout,phone from game_user_info where is_bind=1) b on a.contact = b.phone 
// set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
// where NOT EXISTS (select user_id from game_green_record where sign=2 and a.id = user_id ) and b.cout>0';
            $sql3 = 'update game_member a 
inner join game_user_info b on a.contact = b.phone 
set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
where NOT EXISTS (select user_id from game_green_record where sign=2 and a.id = user_id ) and b.is_bind=1 and b.uid is not null';
            if(Utils::model("member")->execute($sql3)){
                $sql4 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,58,NOW(),2 FROM game_member a 
where not exists(select * from game_green_record where sign = 2 and a.id = user_id)';
                Utils::model("green_record")->execute($sql4);
            } 
        }
        //绑定“88共享”出行APP
        if (Utils::model("task")->where('type',3)->find()) {
//             $sql5 = 'update game_member a 
// inner join (select PHONE, COUNT(PHONE) as cout,SOURCE from game_user_login where SOURCE="SGS") b on a.contact = b.PHONE 
// set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
// where NOT EXISTS (select user_id from game_green_record where sign=3 and a.id = user_id ) and b.cout>0';
            $sql5 = 'update game_member a 
inner join  game_user_login b on a.contact = b.PHONE 
set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
where NOT EXISTS (select user_id from game_green_record where sign=3 and a.id = user_id ) and b.SOURCE="SGS" and b.PHONE is not null';
            if(Utils::model("member")->execute($sql5)){
                $sql6 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,58,NOW(),3 FROM game_member a 
where not exists(select * from game_green_record where sign = 3 and a.id = user_id)';
                Utils::model("green_record")->execute($sql6);
            } 
        }
        //绑定上海农商银行借记卡
        if (Utils::model("task")->where('type',4)->find()) {
//             $sql5 = 'update game_member a 
// inner join (select PHONE, COUNT(PHONE) as cout,PAY_TYPE from game_passenger_trip where PAY_TYPE="SRCB") b on a.contact = b.PHONE 
// set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
// where NOT EXISTS (select user_id from game_green_record where sign=4 and a.id = user_id ) and b.cout>0';
        
            $sql5 = 'update game_member a 
inner join  game_passenger_trip  b on a.contact = b.PHONE 
set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
where NOT EXISTS (select user_id from game_green_record where sign=4 and a.id = user_id ) and b.PAY_TYPE="SRCB" and b.PHONE is not null';

            if(Utils::model("member")->execute($sql5)){
                $sql6 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,58,NOW(),4 FROM game_member a 
where not exists(select * from game_green_record where sign = 4 and a.id = user_id)';
                Utils::model("green_record")->execute($sql6);
            } 
        }

		flush();
	}

    
}
