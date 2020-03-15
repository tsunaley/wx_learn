<?php


namespace app\api\service;


use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code){  //拼接微信api接口路径
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),
            $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl);  //从接口取得返回数据
        $wxResult = json_decode($result, true);  //转为数组
        if(empty($wxResult)){
            throw new Exception('获取session_key及openID时异常，微信内部错误');  //为空抛出异常
        }
        else{
            $loginFail = array_key_exists('errcode', $wxResult);
            if($loginFail){    // 如果返回值有错误码则抛出自定义异常
                $this->processLoginError($wxResult);
            }
            else{   //返回token
                $this->grantToken($wxResult);
            }
        }
    }

    private function processLoginError($wxResult){  //设置抛出异常的msg和errorcode
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);
    }

    private function grantToken($wxResult){
        //拿到openid
        //数据库内是否有这个openid
        //不存在则在user表新增一条记录
        //生成令牌，准备缓存数据，写入缓存
        //把令牌返回客户端
        //key:令牌
        //value:wxResult, uid, scope（权限）
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if($user){
            $uid = $user->id;
        }
        else{
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
    }

    private function newUser($openid){   //user不存在就增加
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;   //返回uid
    }

    private function prepareCachedValue($wxResult, $uid){  //返回要写入缓存的信息
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }

    private function saveCache($cachedValue){
        $key = generateToken();

    }
}