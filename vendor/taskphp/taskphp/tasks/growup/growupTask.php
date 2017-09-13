<?php
namespace tasks\growup;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class growupTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

	    Utils::dbConfig(Utils::config('DB','growup'));

//         //道具使用
//         $sql = 'update game_trees a inner join 
// (select count(*) as cout,trees_id from game_my_prop where status=1) b on a.id = b.trees_id 
// set a.prop_day=1 where b.cout >0';
//         Utils::model("trees")->execute($sql);

//         //setInc prop_day
//         $map['prop_day'] = array('gt',0);
// 	    Utils::model("trees")->where($map)->setInc('prop_day',1);

        Utils::model("trees")->setInc('prop_day',1);

		flush();
	}
}
