<?php


namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code=''){
        (new TokenGet())->goCheck();   //验证code
        $ut = new UserToken($code);
        $token = $ut->get();   //获取token
        return json([
            'token' => $token
        ]);
    }
}