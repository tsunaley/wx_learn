<?php


namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\Theme as ThemeModel;
use app\lib\exception\ThemeException;


class Theme
{
    /**
     * @url /theme?ids=id1, id2, id3,....
     * return 一组theme模型
     */
    public function getSimpleList($ids=''){
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')->select($ids); //select返回一组数据
        if($result->isEmpty()){
            throw new ThemeException();
        }
        return json($result, 200);
    }

    public function getComplexOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProduct($id);
        if(!$theme){
            throw new ThemeException();
        }
        return json($theme, 200);
    }
}