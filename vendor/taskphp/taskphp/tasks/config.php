<?php
//系统配置
return array(
    //指定用户  nobody  www
    'core_user'         =>'nobody',
    //指定任务进程最大内存
    'memory_limit'      =>'256M',
    //单个进程执行的任务数 0无限  大于0为指定数
    'worker_limit'       =>0,
    //worker进程运行模式
    //0.自动模式 默认
    //1.多进程模式
    //2.单进程模式 
    //3.多线程模式
    'worker_mode'       =>0,
    //任务列表
    'task_list'=>array(
        //demo任务 
        'demo'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 20 1 * * * *', 
        ),
        
        'userinfo'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 10 0 * * * *', 
        ),
        'syncuserinfo'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 50 0 * * * *', 
        ),
        
        'driver'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 20 1 * * * *', 
        ),
        'syncdriver'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 50 1 * * * *', 
        ),
        'passenger'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 20 2 * * * *',  
        ),
        'syncpassenger'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 50 2 * * * *',  
        ),
        'wxsport'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 20 3 * * * *', 
        ),
        'syncwxsport'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 50 3 * * * *', 
        ),

        
        'growup'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 20 4 * * * *',  
        ),
        'level'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 50 4 * * * *',  
        ),
        
        'login'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 10 5 * * * *', 
        ),
        
        'synctask'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 40 5 * * * *', 
        ),

        'syncgreen'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 20 6 * * * *', 
        ),
        
        'rank'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 50 6 * * * *', 
        ),
        'disaster'=>array(
            //class名称,(设置true或者不设置此参数)代表tasks目录里面的任务会自动找到该任务的class名称,非tasks目录里面的任务则填写完整的class名称core\lib\xxxx
            'class_name'=>true,   
            //crontad格式 :秒 分 时 天 月 年 周
            'timer'     =>'10 20 7 * * * *', 
        ),
    ),
);