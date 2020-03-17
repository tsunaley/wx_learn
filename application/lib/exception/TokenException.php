<?php


namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token过期，或者无效Token';
    public $errorCode = 10001;
}