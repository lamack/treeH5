<?php
namespace tasks\rank;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class rankTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

	    Utils::dbConfig(Utils::config('DB','rank'));

//         $sql = 'update game_member a inner join 
// (select count(*) as cout,user_id from game_trees where 1) b on a.id = b.user_id 
// set a.trees=b.cout  where b.cout >0 ';
        $sql = 'UPDATE game_member  a SET a.trees = (SELECT count(*) FROM game_trees WHERE user_id = a.id)';

        Utils::model("member")->execute($sql);

        $sql3 = 'delete from game_rank';
        Utils::model("rank")->execute($sql3);

        $sql1 = 'INSERT INTO game_rank
            (type,name,green,user_id)
  select 0,username,trees,id from game_member where 
not exists(select * from game_rank where game_rank.user_id=game_member.id ) and  game_member.type = 0 AND game_member.trees>0  order by trees DESC, green_max DESC, share DESC,  total_time ASC  ';
        Utils::model("rank")->execute($sql1);
        //班组排名 综合排名
 //        $sql2 = 'INSERT INTO game_rank
 //           (type,name,green)
 // select 1,class,sum(trees) as max from game_member where not exists(select * from game_rank where game_rank.name=game_member.class and game_rank.type=1 ) and  game_member.class is not null  and game_member.trees>0 group by class_no order by max DESC limit 100';
 //        Utils::model("rank")->execute($sql2);
        //
 //        //个人
 //        $sql = 'INSERT INTO game_rank
 //           (type,name,green,user_id)
 // select 0,username,green_max,id from game_member where not exists(select * from game_rank where game_rank.user_id=game_member.id ) and  game_member.type = 0 limit 100';
 //        Utils::model("rank")->execute($sql);
 //        //司机
 //        $sql1 = 'INSERT INTO game_rank
 //           (type,name,green,user_id)
 // select 1,username,green_max,id from game_member where not exists(select * from game_rank where game_rank.user_id=game_member.id ) and  game_member.type = 1 limit 100';
 //        Utils::model("rank")->execute($sql1);
 //        //植树达人(果实)
 //        $sql2 = 'INSERT INTO game_rank
 //           (type,name,green,user_id)
 // select * from (SELECT 2,username,COUNT(trees_id) as green_max ,game_member.id as tid FROM game_member JOIN game_furit) AS tb where not exists(select * from game_rank where game_rank.user_id=tb.tid and game_rank.type=2)  limit 100';
 //        Utils::model("rank")->execute($sql2);
 //        //红色寻访达人（答题）
 //        $sql3 = 'INSERT INTO game_rank
 //           (type,name,green,user_id)
 // select * from (SELECT 3,username,sum(game_vie.right) as green_max ,game_member.id as tid FROM game_member JOIN game_vie) AS tb where not exists(select * from game_rank where game_rank.user_id=tb.tid and game_rank.type=3)  limit 100';
 //        Utils::model("rank")->execute($sql3);
 //        //班组排名 综合排名
 //        $sql4 = 'INSERT INTO game_rank
 //           (type,name,green)
 // select 4,class,sum(green_max) as max from game_member where not exists(select * from game_rank where game_rank.name=game_member.class and game_rank.type=4) group by class_no limit 100';
 //        Utils::model("rank")->execute($sql4);
 //        //绿色出行排名
 //        $sql5 = 'INSERT INTO game_rank
 //           (type,name,green)
 // select 5,class,sum(steps) as max from game_member where not exists(select * from game_rank where game_rank.name=game_member.class and game_rank.type=5) group by class_no limit 100';
 //        Utils::model("rank")->execute($sql5);
        
 //        //企业排名
 // //        $sql6 = 'INSERT INTO game_rank
 // //           (type,name,green)
 // // select 6,company,sum(green_max) as max from game_member where not exists(select * from game_rank where game_rank.name=game_member.company ) group by  company_no limit 100';
 // //        Utils::model("rank")->execute($sql6);
 //        //地区排名
 //        $sql7 = 'INSERT INTO game_rank
 //           (type,name,green)
 // select 7,area,sum(green_max) as max from game_member where not exists(select * from game_rank where game_rank.name=game_member.area  ) group by  area limit 100';
 //        Utils::model("rank")->execute($sql7);

 //        //产业局
 //        $sql8 = 'INSERT INTO game_rank
 //           (type,name,green)
 // select 8,industry,sum(green_max) as max from game_member where not exists(select * from game_rank where game_rank.name=game_member.industry  ) group by  industry_no limit 100';
 //        Utils::model("rank")->execute($sql8);

		flush();
	}
}
