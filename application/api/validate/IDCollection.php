<?php


namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule=[
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数必须为逗号分隔的正整数'
    ];

    //$value为客户端传入的值
    protected function checkIDs($value){
        $values = explode(',', $value);  //将传入的值分隔为一个数组
        if(empty($values)){
            return false;
        }
        foreach ($values as $id){
            if(!$this->isPositiveInteger($id))
                return false;
        }
        return true;
    }
}