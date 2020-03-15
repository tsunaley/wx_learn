<?php


namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time', 'topic_img_id', 'head_img_id'];
    public function topicImg()
    {
        //一对一
        //外键在这个表里用belongsTo  不在用hasOne
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    public function products(){
        return $this->belongsToMany('Product', 'theme_product', 'product_id', 'theme_id');
    }

    public static function getThemeWithProduct($id){
        $theme = self::with('Products,topicImg,headImg')->find($id);
        return $theme;
    }
}