<?php


namespace app\api\service;


class Token
{
    public static function generateToken(){
        //32个字符组成随机字符串
        $randChar =getRandChar(32); //公共函数
        //用三组字符串进行MD5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //salt
        $salt = config('secure.token_salt');
        return md5($randChar.$timestamp.$salt);
    }
}