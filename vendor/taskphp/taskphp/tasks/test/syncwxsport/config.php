<?php
return array(
    /**
     * 数据库配置
     *   */
    'DB'=>array(
        'DB_TYPE'   => "mysql", // 数据库类型
        'DB_HOST'   => "139.196.20.81", // 服务器地址
        'DB_NAME'   => "dolphin", // 数据库名
        'DB_USER'   => "root", // 用户名
        'DB_PWD'    => "Innketek201306",  // 密码
        'DB_PORT'   => 3306, // 端口
        'DB_PREFIX' => "game_", // 数据库表前缀
        'DB_PARAMS'=>array('persist'=>true),//是否支持长连接
    ),
);