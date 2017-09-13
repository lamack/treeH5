<?php
namespace tasks\disaster;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class disasterTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
    public function run(){

        Utils::dbConfig(Utils::config('DB','disaster'));



        $disaster =  Utils::model("disaster")->where(' end_time > UNIX_TIMESTAMP() and start_time < UNIX_TIMESTAMP() ')->find();

        if($disaster === false){
        flush();
            exit;
        }

        Utils::model("disaster")->where(array("id",$disaster['id']))->save(array('status'=>2));
        



        //找出没道具去成长值 
        $sql=' update game_trees 
                set level = 1,disaster=1
                where status = 0 and disaster=0 and level =2 and user_id not in (select user_id from game_my_prop WHERE prop_type = 4 and `status`=0 )';
        Utils::model("trees")->execute($sql);

        //有道具
        $sql1='update game_my_prop a inner join(select * from game_my_prop where status = 0 and prop_type=4 limit 1) b on a.id = b.id
inner join(select * from game_trees where status = 0 and level=2 and disaster=0) c on a.user_id = c.user_id
set  a.disaster_id = ceiling(RAND()*3),a.status=1,a.trees_id=c.id where 
a.status = 0  and a.prop_type=4 and a.id = b.id ';
        Utils::model("my_prop")->execute($sql1);

        $sql2 ='UPDATE game_trees INNER JOIN game_my_prop ON game_trees.id=game_my_prop.trees_id
SET game_trees.disaster=1 WHERE game_my_prop.status=1 and game_my_prop.prop_type=4';
        Utils::model("my_prop")->execute($sql2);

//         //公告时间
//         $sql = 'INSERT INTO game_adv_disaster
//            (disaster_id,disaster_type,start_time)
//  select id,disaster_type,start_time from game_disaster where not exists(select * from game_adv_disaster where game_adv_disaster.disaster_id=game_disaster.id ) and push_flish_time+3600 >UNIX_TIMESTAMP(now())' ;

//         //护盾道具
//         if(Utils::model("adv_disaster")->execute($sql)){
//             $disaster = Utils::model("adv_disaster")->order('id DESC')->find();
            
//             //去道具
//             if ($disaster&&!Utils::model("my_prop")->where('disaster_id',$disaster['id'])->find()){
//                 //减少成长值
//                 $decreaseArr = Utils::model("prop")->where('id',$disaster['id'])->find();
//                 $develop = Utils::model("develop")->find();
//                 switch ($decreaseArr['position']) {
//                     case '1':
//                         $decrease = $develop['lives_typhoon'];
//                         break;
//                     case '2':
//                         $decrease = $develop['lives_flood'];
//                         break;
//                     case '3':
//                         $decrease = $develop['lives_drought'];
//                         break;           
//                 }
                
//                 //没有道具减成长值 
//                     //找出没道具去成长值 | 找出对应灾害要去掉的成长值 | 最低为0
//                 $sql1='
//                         update game_trees 
//                         set lifes =  CASE
//                             WHEN lifes > '.$decrease.' THEN lifes-'.$decrease.'
//                             WHEN lifes <= '.$decrease.' THEN 0
//                             END
//                         where status = 0 and user_id not in (select user_id from game_my_prop WHERE prop_type = 4 and `status`=0)';
//                 Utils::model("trees")->execute($sql1);
//                 //有道具
//                 $sql2='update game_my_prop a inner join (select  disaster_id from game_adv_disaster where 1 order by id DESC limit 1) c
// set  a.disaster_id = c.disaster_id,a.`status`=1 where a.status = 0  and a.prop_type=4;';
//                 Utils::model("my_prop")->execute($sql2);

//             }

            

//         }
        

        flush();
    }
}
