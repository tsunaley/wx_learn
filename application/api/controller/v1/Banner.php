<?php


namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id){
        (new IDMustBePositiveInt())->goCheck();  //调用验证器验证参数
        $banner = BannerModel::getBannerByID($id);  //从模型中获取对应数据
        if(!$banner){
            throw new BannerMissException();   //为空的错误处理
        }
        return json($banner, 200);
    }
}