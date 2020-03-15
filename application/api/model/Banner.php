<?php


namespace app\api\model;


class Banner extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time'];   //隐藏不想用户看到的数据
    public function items(){
        return $this->hasMany('BannerItem', 'banner_id', 'id');  //一对多 通过id连接
    }
    public static function getBannerByID($id){
        $banner = self::with(['items', 'items.img'])->get($id);
        return $banner;
    }
}