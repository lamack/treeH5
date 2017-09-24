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
        Utils::log(time().':tasks\syncgreen\syncgreen task one [--START--]');
        //注册了申工社APP
        if (Utils::model("task")->where('type',1)->find()) {
//             $sql1 = 'update game_member a 
// inner join game_user_info b on a.contact = b.phone 
// set a.green_nocash = a.green_nocash+38 , green_max = a.green_max+38 
// where NOT EXISTS (select user_id from game_green_record where sign=1 and a.id = user_id ) and b.uid is not null';

            $sql1 = 'update game_member a 
inner join game_user_info b on a.contact = b.phone left join game_green_record c on a.id = c.user_id
set a.green_nocash = a.green_nocash+38 , green_max = a.green_max+38 
where  c.sign=1 and c.user_id is null and b.uid is not null';
            if(Utils::model("member")->execute($sql1)){
                $sql2 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,38,unix_timestamp(),1 FROM game_member a 
where not exists(select * from game_green_record where sign = 1 and a.id = user_id)';
                Utils::model("green_record")->execute($sql2);
            } 
          
        }
         Utils::log(time().':tasks\syncgreen\syncgreen task one [--END--]');  
        //绑定“申工社”APP
        Utils::log(time().':tasks\syncgreen\syncgreen task two [--START--]');
        if (Utils::model("task")->where('type',2)->find()) {
        
//             $sql3 = 'update game_member a 
// inner join game_user_info b on a.contact = b.phone 
// set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
// where NOT EXISTS (select user_id from game_green_record where sign=2 and a.id = user_id ) and b.is_bind>0 and b.uid is not null';
            $sql3 = 'update game_member a 
inner join game_user_info b on a.contact = b.phone left join game_green_record c on a.id = c.user_id
set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
where c.sign=2 and c.user_id is null and b.is_bind>0 and b.uid is not null';

            if(Utils::model("member")->execute($sql3)){
                $sql4 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,58,unix_timestamp(),2 FROM game_member a 
where not exists(select * from game_green_record where sign = 2 and a.id = user_id)';
                Utils::model("green_record")->execute($sql4);
            } 
            
        }
        Utils::log(time().':tasks\syncgreen\syncgreen task two [--END--]'); 
        //绑定“88共享”出行APP
        Utils::log(time().':tasks\syncgreen\syncgreen task three [--START--]');
        if (Utils::model("task")->where('type',3)->find()) {
        
//             $sql5 = 'update game_member a 
// inner join  game_user_login b on a.contact = b.PHONE 
// set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
// where NOT EXISTS (select user_id from game_green_record where sign=3 and a.id = user_id ) and b.SOURCE="SGS" and b.PHONE is not null';
            $sql5 = 'update game_member a 
inner join  game_user_login b on a.contact = b.PHONE left join game_green_record c on a.id = c.user_id
set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
where c.sign=3 and c.user_id is null and b.SOURCE="SGS" and b.PHONE is not null';
            if(Utils::model("member")->execute($sql5)){
                $sql6 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,58,unix_timestamp(),3 FROM game_member a 
where not exists(select * from game_green_record where sign = 3 and a.id = user_id)';
                Utils::model("green_record")->execute($sql6);
            } 
        }
        Utils::log(time().':tasks\syncgreen\syncgreen task three [--END--]');
        //绑定上海农商银行借记卡
        Utils::log(time().':tasks\syncgreen\syncgreen task four [--START--]');
        if (Utils::model("task")->where('type',4)->find()) {
//             $sql5 = 'update game_member a 
// inner join  game_passenger_trip  b on a.contact = b.PHONE 
// set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
// where NOT EXISTS (select user_id from game_green_record where sign=4 and a.id = user_id ) and b.PAY_TYPE="SRCB" and b.PHONE is not null';
        
            $sql5 = 'update game_member a 
inner join  game_passenger_trip  b on a.contact = b.PHONE left join game_green_record c on a.id = c.user_id
set a.green_nocash = a.green_nocash+58 , green_max = green_max+58 
where c.sign=4 and c.user_id is null and b.PAY_TYPE="SRCB" and b.PHONE is not null';

            if(Utils::model("member")->execute($sql5)){
                $sql6 = 'insert into game_green_record (user_id,green,create_time,sign) 
SELECT id,58,unix_timestamp(),4 FROM game_member a 
where not exists(select * from game_green_record where sign = 4 and a.id = user_id)';
                Utils::model("green_record")->execute($sql6);
            } 
        }
        Utils::log(time().':tasks\syncgreen\syncgreen task four [--END--]');
        //司机首单获取20元洗车券
        Utils::log(time().':tasks\syncgreen\syncgreen task five [--START--]');
        if (Utils::model("task")->where('type',5)->find()) {
        
            $sql5 = 'insert into game_recode(user_id,conpon_id,create_time,type) SELECT a.id,1,unix_timestamp(),1 
FROM game_member a   join  game_driver_trip b on a.contact = b.PHONE 
WHERE ( SELECT count(id) as count FROM game_recode WHERE game_recode.user_id = a.id) <1 
and ( SELECT count(PHONE) as count FROM game_driver_trip WHERE PHONE = a.contact)>0
and b.PHONE is not null  GROUP BY a.id';

            if(Utils::model("recode")->execute($sql5)){
                //
                $map['type'] = 1;
                $map['conpon_id'] = 1;
                $res = Utils::model("recode")->where($map)->select();
                foreach ($res as $key => $value) {
                    //查询
                    $sql6 = 'update game_recode a 
set conpon_id =  (select c.id as cid from game_conpon c left join game_conpon_type b on c.conpon_type = b.id where c.conpon_status = 0 and b.copon_type=1 limit 1 ) 
where a.conpon_id=1 and a.type = 1 limit 1';
                    Utils::model("recode")->execute($sql6);
                    $sql6 = 'update game_conpon a left join game_recode b on a.id = b.conpon_id
set conpon_status =  1 
where b.type = 1 ';
                    Utils::model("conpon")->execute($sql6);


                }
                //分配为空的即删除
                $del['conpon_id'] = 0;
                $del['type'] = 1;
                Utils::model("recode")->where($del)->delete();
                
            } 
        }
        Utils::log(time().':tasks\syncgreen\syncgreen task five [--END--]');
        //司机首次完成10单拼车获取20元洗车券
        Utils::log(time().':tasks\syncgreen\syncgreen task six [--START--]');
        if (Utils::model("task")->where('type',6)->find()) {
        
            $sql5 = 'insert into game_recode(user_id,conpon_id,create_time,type) SELECT a.id,1,unix_timestamp(),1 
FROM game_member a   join  game_driver_trip b on a.contact = b.PHONE 
WHERE ( SELECT count(id) as count FROM game_recode WHERE game_recode.user_id = a.id) <2 
and ( SELECT count(PHONE) as count FROM game_driver_trip WHERE PHONE = a.contact)>9
and b.PHONE is not null  GROUP BY a.id';

            if(Utils::model("recode")->execute($sql5)){
                //
                $map['type'] = 1;
                $map['conpon_id'] = 1;
                $res = Utils::model("recode")->where($map)->select();
                foreach ($res as $key => $value) {
                    //查询
                    $sql6 = 'update game_recode a 
set conpon_id =  (select c.id as cid from game_conpon c left join game_conpon_type b on c.conpon_type = b.id where c.conpon_status = 0 and b.copon_type=1 limit 1 ) 
where a.conpon_id=1 and a.type = 1 limit 1';
                    Utils::model("recode")->execute($sql6);
                    $sql6 = 'update game_conpon a left join game_recode b on a.id = b.conpon_id
set conpon_status =  1 
where b.type = 1 ';
                    Utils::model("conpon")->execute($sql6);
                }
                //分配为空的即删除
                $del['conpon_id'] = 0;
                $del['type'] = 1;
                Utils::model("recode")->where($del)->delete();
                
            } 
        }
        Utils::log(time().':tasks\syncgreen\syncgreen task six [--END--]');
		flush();
	}

    
}
