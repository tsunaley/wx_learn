<?php


namespace app\api\validate;


class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [  //验证器
        'id' => 'require|isPositiveInteger'
    ];

    protected $message = [
        'id' => 'id必须是正整数'
    ];
}