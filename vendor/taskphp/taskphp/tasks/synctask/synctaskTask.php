<?php
namespace tasks\synctask;
use core\lib\Task;
use core\lib\Utils;
use core\lib\http\Client;
/**
 * 测试任务 
 */
class synctaskTask extends Task{
    /**
     * 任务入口
     * (non-PHPdoc)
     * @see \core\lib\Task::run()
     */
	public function run(){

	    Utils::dbConfig(Utils::config('DB','synctask'));

        //获取所有完成任务记录
        $sql = 'SELECT *,sum(green) as total FROM game_task_recode a WHERE  NOT EXISTS( SELECT task_id  FROM game_task_process b WHERE  task_id=a.task_id) GROUP BY a.task_id';
        $taskarr = Utils::model("task_recode")->query($sql);

        //简单处理
        foreach ($taskarr as $key => $value) {
            $user_id = $this->_getuserid($value);
            if (!$user_id) {
                continue;
            }
            $data['user_id'] = $user_id;
            $data['task_id'] = $value['task_id'];
            $data['status'] = $user_id;
            $data['create_time'] = time();
            Utils::model("task_process")->add($data);
            //生成获得记录
            $recode['user_id'] = $user_id;
            $recode['green'] = $value['total'];
            $recode['create_time'] = time();
            Utils::model("green_record")->add($recode);
        }  

		flush();
	}

    public function _getuserid($val){
        $user_id = 0;
        if ($val['coupon_no']) {
            $user_id = Utils::model("recode")->alias('a')->join(' conpon b',' b.id = a.conpon_id','LEFT')->where('b.conpon_no',$val['coupon_no'])->getField('user_id');
        }else{
            $user_id = Utils::model("member")->where('contact',$val['mobile'])->getField('id');
        }

        return $user_id;

    }
}
