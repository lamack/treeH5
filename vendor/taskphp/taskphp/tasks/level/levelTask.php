<?php
namespace tasks\level;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class levelTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

	    Utils::dbConfig(Utils::config('DB','level'));

        //成长到第二阶段 new
        $sql = 'update game_trees set `level`=2 where prop_day > 1 and level =1 ';
        Utils::model("trees")->execute($sql);

        //成长到第二阶段
        // $sql = 'update game_trees set `level`=2 where prop_day = 1 and TO_DAYS(upate_time) <> TO_DAYS(NOW())';
        // Utils::model("trees")->execute($sql);


        //第三阶段 new
        $sql1 = 'update game_trees set level=3,status=1 where status = 0  AND prop_day>4 and level=2';
        Utils::model("trees")->execute($sql1);

        //第三阶段
//         $sql1 = 'update game_trees a inner join 
// (select count(*) as cout,trees_id from game_my_prop where status=1) b on a.id = b.trees_id 
// set a.level=3,a.status=1 where b.cout >1 AND a.status = 0 AND a.disaster = 1 AND a.prop_day>2 and TO_DAYS(upate_time) <> TO_DAYS(NOW())';
//         Utils::model("trees")->execute($sql1);

        //处理prop_use new
       $sql2 = 'update game_trees a inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=1) b on a.id = b.trees_id inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=2) c on a.id = c.trees_id inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=3) d on a.id = d.trees_id set a.prop_use=1 where b.cout >0 and c.cout>0 and d.cout>0';
       Utils::model("trees")->execute($sql2);

       //处理prop_use
       // $sql2 = 'update game_trees a inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=1) b on a.id = b.trees_id inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=2) c on a.id = c.trees_id inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=3) d on a.id = d.trees_id set a.prop_use=1 where b.cout >0 and c.cout>0 and d.cout>0';
       // Utils::model("trees")->execute($sql2);

       //结果状态设置 new
       $sql3 = 'update game_trees set status = 2 where prop_use = 1 AND prop_day>4 AND status =1 ';
       Utils::model("trees")->execute($sql3);

       // //结果状态设置
       // $sql3 = 'update game_trees set status = 2 where prop_use = 1 AND prop_day>=4 AND status =1 and TO_DAYS(upate_time) <> TO_DAYS(NOW())';
       // Utils::model("trees")->execute($sql3);
       
       //生成果实
        $sql4 = 'insert into game_furit(trees_id,type) SELECT a.id,ceiling(RAND()*2) as type FROM game_trees a WHERE ( SELECT count(id) as count FROM game_furit WHERE game_furit.trees_id = a.id) <2 and level = 3 and status=2 and prop_use=1 and prop_day>4';
        Utils::model("furit")->execute($sql4);
       
        //使用
        $sql5 = 'update game_trees a  inner join (select  trees_id,count(*) as count from game_furit where status=1 ) c on  a.id = c.trees_id
set a.status = 3 where a.level = 3  and a.prop_use=1 and a.status <3 and c.count=2';
        Utils::model("trees")->execute($sql5);


//         $maxLives = Utils::model("develop")->find();
//         $average = 40;

// 	    //40<live<80
// 	    $map['lifes'] = array('between',array($average*1,$average*2));
//         $data['level'] = 2;
// 	    Utils::model("trees")->where($map)->save($data);

//         //80<live<120
//         $map1['lifes'] = array('between',array($average*2,$average*3));
//         $data1['level'] = 3;
//         Utils::model("trees")->where($map1)->save($data1);

//         //live ==120
//         $map2['lifes'] = 120;
//         $map2['status'] = 0;
//         $data2['status'] = 1;
//         Utils::model("trees")->where($map2)->save($data2);

//        //处理prop_use
//        $sql3 = 'update game_trees a inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=1) b on a.id = b.trees_id inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=2) c on a.id = c.trees_id inner join (select count(*) as cout,trees_id from game_my_prop where status=1 and prop_type=3) d on a.id = d.trees_id set a.prop_use=1 where b.cout >1 and c.cout>1 and d.cout>1';
//        Utils::model("trees")->execute($sql3);
        
//         //生成果实
//         $sql2 = 'insert into game_furit(trees_id,type) SELECT a.id,ceiling(RAND()*2) as type FROM game_trees a WHERE ( SELECT count(id) as count FROM game_furit WHERE game_furit.trees_id = a.id) <2 and lifes = 120 and status=1 and prop_use=1';
//         Utils::model("furit")->execute($sql2);

//         //prop使用情况 
        
//         //使用
//         $sql = 'update game_trees a  inner join (select  trees_id,count(*) as count from game_furit where status=1 ) c on  a.id = c.trees_id
// set a.status = 3 where a.lifes = 120  and a.prop_use=1 and a.status <3 and c.count=2';
//         Utils::model("trees")->execute($sql);
//         //未使用
//         $sql1 = 'update game_trees a inner join (select  trees_id,count(*) as count from game_furit where status=0 ) c on  a.id = c.trees_id
// set a.status = 2 where  a.lifes = 120  and a.prop_use=1 and a.status <3 and c.count>0';
//         Utils::model("trees")->execute($sql1);
       
        

		flush();
	}
}
