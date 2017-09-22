<?php


// 门户模块公共函数库
use think\Db;


function _getGreen($uid){
    if (!$uid) {
        return null;
    }
    $me = db('member')->where('id',$uid)->find();
    if ($me) {
        return $me['green_max'];
    }
}

function _getShare($uid){
    if (!$uid) {
        return null;
    }
    $me = db('member')->where('id',$uid)->find();
    if ($me) {
        return $me['share'];
    }
}

function _getTime($uid){
    if (!$uid) {
        return null;
    }
    $me = db('member')->where('id',$uid)->find();
    if ($me) {
        return $me['total_time'];
    }
}



