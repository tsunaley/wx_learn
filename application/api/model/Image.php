<?php

namespace app\api\model;

class Image extends BaseModel  //只要关联了Image都会运行
{
    protected $hidden = ['id', 'from', 'delete_time', 'update_time'];

    public function getUrlAttr($value, $date){
        return $this->prefixImgUrl($value, $date);  //对图片路径进行处理
    }
}
