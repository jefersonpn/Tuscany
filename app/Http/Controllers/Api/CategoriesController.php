<?php

namespace App\Http\Controllers\Api;

use App\Facades\ApiTuscany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CategoriesController;
use Illuminate\Support\Facades\Http;


class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        $categories= $this->GetParentCategory();
        $categoriesFather= ($categories['categoriesFather']);
        $categoriesChild= ($categories['categoriesChild']);

        $data = $this->getAll();
        dd($categoriesFather, $categoriesChild, $data);

        /*  if (!$request->session()->exists('key')) {        
            $this->getAll(); 
        }

        $data = $request->session()->all();  */
        
        return view('main')->with(['data'=>$data, 'categoriesFather'=> $categoriesFather, 'categoriesChild'=> $categoriesChild ]);
                    
    }

    /* Getting only Parent_category CATEGORIES */
    public function GetParentCategory()
    {
        $categories = ApiTuscany::get('categories')->json('response');
        
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
        $this->GetParentCategory();

        $params ="code={$code}";
        $endpoint = "product-info";

        $response = $this->getApi($endpoint,$params);

        return view('product')->with(['products_info' => $response->response, 'categories' => $this->GetParentCategory()]);
        
    }

    public function getApi($endpoint, $params = null, $urlFull = null)
    {
        if($urlFull){
            $url_base = $urlFull;
        }else{
            if($params){
                $param = "?{$params}";
            }
            $url_base = "https://www.tuscanyleather.it/api/v1/{$endpoint}{$param}";
        }
            
            
            $curl = curl_init();
            $url = "{$url_base}";

            curl_setopt_array($curl, array(
            CURLOPT_URL => "{$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3N0YWdlLnR1c2NhbnlsZWF0aGVyLml0L2FwaS92MS9yZWZyZXNoLXRva2VuIiwiaWF0IjoxNjQ1MDM0MzI1LCJleHAiOjE5NjAzOTQzMjUsIm5iZiI6MTY0NTAzNDMyNSwianRpIjoiUzdkQWk4YVlxWVJXdlpxUiIsInN1YiI6MjAwNDgwLCJwcnYiOiIwZTY1ZmVjYWM0NTI5M2Q4ZmRmYzViMzBmMTA4ZDQwNWYwYTVjZGI2In0.9Kzd29szRRgVs-R39Av1NL9dHEmAmSFgu1KAAStxaf8',
                'Cookie: tl_session=TIEZRC12W4Gk1gzfcor0ZpEzNg17KTkhDTTPxNRn'
            ),
            ));
            
            $response = json_decode(curl_exec($curl));
            curl_close($curl);

            return $response;
        
    }


    public function getAll()
    {
        set_time_limit(480);

        $response = $this->GetParentCategory();
        
        $productsArray =  array();
        $code = [];
        $i = null;

        foreach ($response['categoriesChild'] as $key => $value) 
        { 
            for($i = 0; $i < count($value['products']); $i++) 
                {
                    $product = $value['products'][$i];
                    $productData = $this->getApi('product-info', "code={$product}");
                    $productsArray[$i]= array('code' => $value['products'][$i],'items' => isset($productData->response->items) ? $productData->response->items : null);

                    for($y=0; $y < count($productsArray[$i]['items']); $y++)
                    {                        
                        $sku = $productsArray[$i]['items'][$y]->sku;
                        $url = $productsArray[$i]['items'][$y]->details_endpoint;
                        
                        $skuData = $this->getApi('product-info', null,$url);
                    }
                }

                $dataArray[$key]['data'] = [ 
                    'products' => $productsArray,
                    'skuData' => $skuData
                ];

               /*  session('key',$dataArray[$key]);  */
        }

        return $dataArray;
    }
    
    // Principal exercise
    public function principale()
    {

        $categories= $this->GetParentCategory();
        $categoriesFather= ($categories['categoriesFather']);
        $categoriesChild= ($categories['categoriesChild']);

        
        //dd($categoriesFather, $categoriesChild);

        $response= $this->getAllData();
        //dd($response);
        return view('principale')->with(['response' => $response, 'categoriesFather'=> $categoriesFather, 'categoriesChild'=> $categoriesChild]);
    }

    public function getAllData()
    {
        $response = ApiTuscany::get('item-info?sku=1911_1_1')->json('response');
        $productCode= $response['product_code'];
        $productDetails = ApiTuscany::get('product-info?code='.$productCode)->json('response');
        
        return (['response'=>$response, 'productDetails'=> $productDetails]);
    }

    // END- Principal exercise
}
