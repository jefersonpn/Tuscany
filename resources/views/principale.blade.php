
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title></title>
</head>
<body>
    
    <div class="container ms-2 mt-5">
        <div class="col">
            <div class="col-md-4">
              <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
                <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-5 fw-semibold">Categories</span>
                </a>
                {{--         @php dd(/*  $data, */  $categoriesFather, $categoriesChild);    @endphp  
                --}}
                
                <ul class="list-unstyled ps-0">
        
                  @foreach ( $categoriesFather as $categoryFather )
                  {{-- Treatment Area --}}
                    @php
                    $nameToBeId = str_replace(' ', '', $categoryFather['name']);
                    $nameCategoryFather = substr_replace($categoryFather['name'] ,"", -8);
                    @endphp
                  {{-- END - Treatment Area --}}
                
        
                  <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed text-primary" data-bs-toggle="collapse" data-bs-target="#{{ $nameToBeId }}" aria-expanded="false">
                    {{ $nameCategoryFather }}
                    </button>
                    <div class="collapse show" id="{{ $nameToBeId }}">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      @foreach($categoriesChild as $subCategory)
                        @if($subCategory['parent_category_id'] == $categoryFather['category_id'])
                          
                          {{-- Treatment Area --}}
        
                          @php
                          $nameSubToBeId = str_replace(' ', '',  $subCategory['name']);
                          @endphp
        
                          {{-- END - Treatment Area --}}  
        
                        <li class="mb-1">
                          <button class="btn btn-sm btn-toggle align-items-center rounded collapsed text-success ml-3" data-bs-toggle="collapse" data-bs-target="#{{ $nameSubToBeId }}" aria-controls="{{ $nameSubToBeId }}" aria-expanded="false">
                          {{ $subCategory['name'] }}
                          </button>
                          <div class="collapse show" id="{{ $nameSubToBeId }}">
                          <a href="#" class="link-dark rounded"></a>
                          @foreach($subCategory['products'] as $product)
                            <ul>
                              <li><a href="#" >{{ $product }}</a></li>
                            </ul>
                          @endforeach
                        </li>
                        @endif
                      @endforeach
                      </ul>
                    </div>
                  </li>
        
                  @endforeach
                </ul>
              </div>
            </div>
        </div>
        
        <div class="row">Code</div>
        <div class="col text-primary">{{ $response['response']['product_code'] }}</div>
        <div class="row">Name</div>
        <div class="col text-primary">{{ $response['response']['name'] }}</div>
        <div class="row">Color</div>
        <div class="col text-primary">{{ $response['response']['color'] }}</div>
        <div class="row">EAN</div>
        <div class="col text-primary">{{ $response['response']['ean'] }}</div>
        <div class="row">Quantity</div>
        <div class="col text-primary">{{ $response['response']['available_quantity'] }}</div>
        <div class="row">Price</div>
        <div class="col text-primary">€ {{ $response['response']['prices']['list']['default'] }}</div>
        <div class="row">dimension</div>
        <div class="col text-primary">length : {{ $response['productDetails']['dimensions']['product']['length'] }}</div>
        <div class="row">dimension</div>
        <div class="col text-primary">height : {{ $response['productDetails']['dimensions']['product']['height'] }}</div>
        <div class="row">dimension</div>
        <div class="col text-primary">width : {{ $response['productDetails']['dimensions']['product']['width'] }}</div>
        <div class="row">Dettagli</div>
            <div class="row ms-1">Parti metalliche</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Parti metalliche'][0] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Parti metalliche'][1] }}</div>
            <div class="row ms-1">Descrizione esterna</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Descrizione esterna'][0] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Descrizione esterna'][1] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Descrizione esterna'][2] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Descrizione esterna'][3] }}</div>
            <div class="row ms-1">Accessori</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Accessori'][0] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Accessori'][1] }}</div>
            <div class="row ms-1">Composizione</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Composizione'][0] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Composizione'][1] }}</div>
            <div class="row ms-1">Descrizione interni</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Descrizione interni'][0] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Descrizione interni'][1] }}</div>
            <div class="row ms-1">Caratteristiche</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Caratteristiche'][0] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Caratteristiche'][1] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Caratteristiche'][2] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Caratteristiche'][3] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Caratteristiche'][4] }}</div>
            <div class="row ms-1">Chiusura</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['features']['Chiusura'][0] }}</div>
            <div class="row ms-1">items</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][0]['sku'] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][0]['details_endpoint'] }}</div>
                <hr></hr>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][1]['sku'] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][1]['details_endpoint'] }}</div>
                <hr></hr>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][2]['sku'] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][2]['details_endpoint'] }}</div>
                <hr></hr>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][3]['sku'] }}</div>
                <div class="col text-primary ms-3">{{ $response['productDetails']['items'][3]['details_endpoint'] }}</div>
                <hr></hr>
                                 
        
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

</body>
</html>