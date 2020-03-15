<?php


namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '请求的主题不存在，请检查id';
    public $errorCode = 30000;
}