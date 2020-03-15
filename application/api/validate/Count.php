<?php


namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];

    protected $message = [
        'count' => 'count必须是1-15的正整数'
    ];
}