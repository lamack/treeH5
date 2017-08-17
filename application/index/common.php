<?php


// 门户模块公共函数库
use think\Db;

if (!function_exists('is_mobile')) {
    
    function is_mobile(){

        // 如果监测到是指定的浏览器之一则返回true
        
        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
        
       $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
        
        $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
        
        $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";   
        
        $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
        
        $regex_match.=")/i";
        
        // preg_match()方法功能为匹配字符，既第二个参数所含字符是否包含第一个参数所含字符，包含则返回1既true
        return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
    }

    function get_conpon($cid){
        if (!$cid) {
            return null;
        }
        $conpon = db('conpon')->alias('a')->join(' conpon_type b',' b.id = a.conpon_type','LEFT')->where('a.id',$cid)->find();
        if ($conpon) {
            return $conpon['conpon_name'];
        }
    }

    function __mdate($time = NULL) {
        $text = '';
        $time = $time === NULL || $time > time() ? time() : intval($time);
        $t = time() - $time; //时间差 （秒）
        $y = date('Y', $time)-date('Y', time());//是否跨年
        switch($t){
         case $t == 0:
           $text = '刚刚';
           break;
         case $t < 60:
          $text = $t . '秒前'; // 一分钟内
          break;
         case $t < 60 * 60:
          $text = floor($t / 60) . '分钟前'; //一小时内
          break;
         case $t < 60 * 60 * 24:
          $text = floor($t / (60 * 60)) . '小时前'; // 一天内
          break;
         case $t < 60 * 60 * 24 * 3:
          $text = floor($time/(60*60*24)) ==1 ?'昨天 ' . date('H:i', $time) : '前天 ' . date('H:i', $time) ; //昨天和前天
          break;
         case $t < 60 * 60 * 24 * 30:
          $text = date('m月d日 H:i', $time); //一个月内
          break;
         case $t < 60 * 60 * 24 * 365&&$y==0:
          $text = date('m月d日', $time); //一年内
          break;
         default:
          $text = date('Y年m月d日', $time); //一年以前
          break;
        }
            
        return $text;
    }

    function __get_rand($arr)
    {
        $pro_sum=array_sum($arr);
        $rand_num=mt_rand(1,$pro_sum);
        $tmp_num=0;
        foreach($arr as $k=>$val)
        {    
            if($rand_num<=$val+$tmp_num)
            {
                $n=$k;
                break;
            }else
            {
                $tmp_num+=$val;
            }
        }
        return $n;
    }
}

