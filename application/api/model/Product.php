<?php


namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = ['delete_time', 'category_id', 'pivot', 'from', 'create_time', 'update_time'];

    public function getMainImgUrlAttr($value, $date){
        return $this->prefixImgUrl($value, $date);  //对图片路径进行处理
    }

    public function imgs(){
        return $this->hasMany('ProductImage','product_id', 'id');
    }

    public function properties(){
        return $this->hasMany('ProductProperty','product_id', 'id');
    }

    public static function getMostRecent($count){
        $products = self::limit($count)->order('create_time desc')->select();  //查询$count条数据 降序
        return $products;
    }

    public static function getProductsByCategoryID($categoryID){
        $products = self::where('category_id', '=', $categoryID)->select();
        return $products;
    }

    public static function getProductDetail($id){
        $product = self::with(['imgs.imgUrl'])->with(['properties'])->order('imgs.imgUrl.order asc')->find($id);
        return $product;
    }
}