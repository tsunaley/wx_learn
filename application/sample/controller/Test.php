<?php


namespace app\sample\controller;


use think\Controller;
use think\Request;

class Test
{
    public function hello($id)
    {
//        echo $id; //直接就能获得参数？？？

//        $id = Request::instance()->param('id'); 5.0版本

//        return $this->request->params('id'); 傻子错误 应该是param

//        $all = $this->request->post(); //route()获取路径参数，get()获取?后参数,post()获得post body内参数
//        var_dump($all);

//        $id = $this->request->param('id');
//        $name = $this->request->param('name');
//        echo $id;
//        echo ' ';
//        echo $name;

//        $all = input('param.name');
//        var_dump($all);

//        $request = new Request();
//        $all = $request->param();
//        var_dump($all);
//        return 'hello world!';
    }
}