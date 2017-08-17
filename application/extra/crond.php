<?php  

  
$crond_list = array(  
    '*' => [  
        'app\command\Index::firstTest'  
    ],  //每分钟  
  
    '00:00'      => [],  //每周 ------------  
    '*-01 00:00' => [],  //每月--------  
    '*:00'       => [],  //每小时---------  
  
);  
  
return $crond_list; 