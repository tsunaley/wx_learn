<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    protected function prefixImgUrl($value, $date)
    {
        $finaUrl = $value;
        if ($date['from'] == 1){   //from等于1 图片在本地
            $finaUrl = config('setting.img_prefix') . $value;  //获取基地址在加上图片名
        }
        return $finaUrl;   //返回地址
    }
}
