<?php

namespace App\Http\Controllers\Api;

use App\Facades\ApiTuscany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CategoriesController;
use Illuminate\Support\Facades\Http;


class CategoriesController extends Controller
{
    public function principale($lang= null)
    {
        session()->put('language', $lang);

        $categories= $this->GetParentCategory();
        $categoriesFather= ($categories['categoriesFather']);
        $categoriesChild= ($categories['categoriesChild']);
        //dd($categoriesFather, $categoriesChild);
        return view('principale')->with(['categoriesFather'=> $categoriesFather, 'categoriesChild'=> $categoriesChild]);
    }

    /* Getting only Parent_category CATEGORIES */
    public function GetParentCategory()
    {
       
        if (session()->has('language'))
        {
           $language= session('language');
            $categories = ApiTuscany::get('categories?language='.$language)->json('response');
        }else
        {
            $categories = ApiTuscany::get('categories')->json('response');
        }

        $categoriesChild= array();
        $categoriesFather= array();

        for($i = 0; $i < count($categories); $i++) 
        {
            //dd($categories[0]['parent_category_id']);
            while($i < count($categories))
                if(isset($categories[$i]['parent_category_id']))
                    {
                        $categoriesChild[$i]= ($categories[$i]);
                        $i++;
                    }else
                    {
                        $categoriesFather[$i]= ($categories[$i]);
                        $i++;
                    }
        }
        $categoriesChild = array_values($categoriesChild);
        $categoriesFather = array_values($categoriesFather);

        //dd($categoriesChild);
       
        return ['categoriesChild'=>$categoriesChild, 'categoriesFather'=>$categoriesFather];
    }
    /* END- Getting only Parent_category CATEGORIES */
    public function GetProducts($code)
    {
        if (session()->has('language'))
         {
            $language= session('language');
            $categories = $this->GetParentCategory($language);
            //dd($language);
        }else
        {
            $categories = $this->GetParentCategory();
        }
        
        $categoriesFather = ($categories['categoriesFather']);
        $categoriesChild = ($categories['categoriesChild']);
        if (session()->has('language'))
        {
            $language= session('language');
            $productInfo = ApiTuscany::get('product-info?code='.$code.'&language='.$language)->json('response');
            $colors= '';
            foreach ($productInfo['items'] as $i => $item)
            {
                $sku = $item['sku'];
                //dd($sku);
                $count=0;
                while ($count < 1)
                {
                    $itemInfo = ApiTuscany::get('item-info?language='.$language.'&sku='.$sku)->json('response');
                    $color[] = $itemInfo['color'];
                    $count++;
                }
            }//dd($color);
            $firstSKU = $productInfo['items'][0]['sku'];
            //dd($firstSKU);
            $itemInfo = ApiTuscany::get('item-info?language='.$language.'&sku='.$firstSKU)->json('response');
            //dd($itemInfo);

        }
        else
        {
            $productInfo = ApiTuscany::get('product-info?code='.$code)->json('response');
            //dd($productInfo);
        $colors= '';
        foreach ($productInfo['items'] as $i => $item)
        {
            $sku = $item['sku'];
            //dd($sku);
            $count=0;
            while ($count < 1)
            {
                $itemInfo = ApiTuscany::get('item-info?sku='.$sku)->json('response');
                $color[] = $itemInfo['color'];
                $count++;
            }
        }//dd($color);
        $firstSKU = $productInfo['items'][0]['sku'];
        //dd($firstSKU);
        $itemInfo = ApiTuscany::get('item-info?sku='.$firstSKU)->json('response');
        //dd($itemInfo);
        }
        
        return view('product')->with(['productInfo' => $productInfo, 'firstSKU'=>$firstSKU, 'itemInfo'=>$itemInfo, 'colors' => $color]);
    }

    public function showItemSelect($colorSelected) 
    {
        if (session()->has('language'))
         {
            $language= session('language');
            $items = ApiTuscany::get('item-info?language='.$language.'&sku='.$colorSelected)->json('response');
        }else
        {
            $items = ApiTuscany::get('item-info?sku='.$colorSelected)->json('response');
        }
        
        return view('colorSelected')->with(['items' => $items]);
    }
}