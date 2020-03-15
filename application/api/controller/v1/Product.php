<?php


namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;


class Product
{
    public function getRecent($count=15){
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if ($products->isEmpty()){
            new ProductException();
        }
        $products = $products->hidden(['summary']);//隐藏summary
        return json($products, 200);
    }

    public function getAllInCategory($id){
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return json($products, 200);
    }
}