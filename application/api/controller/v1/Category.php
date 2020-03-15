<?php


namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories(){
        $categories = CategoryModel::all([],'Img');  //相当于with()->select()
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return json($categories, 200);
    }
}