<?php


namespace app\lib\exception;


use Exception;
use think\exception\Handle;
use think\facade\Log;
use think\facade\Request;

class ExceptionHandler extends Handle  //错误处理都会经过这里
{
    private $code;
    private $msg;
    private $errorCode;
    //返回客户端当前请求的url路径

    public function render(Exception $e)
    {
        if($e instanceof BaseException){
            //如果是自定义异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }
        else{
            if(config('app_debug')){   //开启了调试模式就返回错误页面
                return parent::render($e);
            }
            else {   //否则返回错误码
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
                $this->recordErrorLog($e);  //记录入日志
            }
        }
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => Request::url()
        ];
        return json($result, $this->code);
    }
    private function recordErrorLog(Exception $e){
        Log::write($e->getMessage(), 'innerError');
        Log::save();
    }
}