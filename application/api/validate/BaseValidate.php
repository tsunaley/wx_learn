<?php


namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
//        $request = new Request;
//        $params = $request->param();//获取传入的值
        $params = Request::param();


        $result = $this->batch()->check($params);//根据子类定义的规则进行验证
        if(!$result){
            $e = new ParameterException([
                'msg' => $this->error    //将错误描述返回给msg
            ]);//面向对象 更改，下边两行可用
//            $e->msg = $this->error;
//            $e->errorCode = 10002;
            throw $e;
        }
        else{
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule='', $data='', $field='')//自定义的验证规则 必须是整数
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return false;
    }

    protected function isNotEmpty($value, $rule='', $data='', $field='')//自定义的验证规则 必须是整数
    {
        if (empty($value)) {
            return false;
        }
        return true;
    }
}