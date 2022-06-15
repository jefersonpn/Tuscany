<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $productInfo['code'] }}</title>
</head>

<body>
    <div class="container ms-2 mt-5">
        {{-- @php dd($productInfo, $firstSKU, $itemInfo, $colors) ;   @endphp --}}
        <div class="row">
            <h3>Code</h3>
        </div>
        <div class="col text-primary">
            <h2>{{ $productInfo['code'] }}</h2>
        </div>
        <div class="row">Name</div>
        <div class="col text-primary">{{ $itemInfo['name'] }}</div>
        {{-- Parei aqui ia colocar os links nas cores para quando clicar chamar outra tela com a cor selecionada --}}
        <div class="row">Color</div>
        <div class="col text-primary">
            @for ($i = 0; $i < count($productInfo['items']); $i++)
                @php
                    /*  dd($productInfo['items'][$i]['sku'], $colors[$i]); */
                @endphp
                <a href="/colorSelected/{{ $productInfo['items'][$i]['sku'] }}">{{ $colors[$i] }}</a>
            @endfor


        </div>
        <div class="row">EAN</div>
        <div class="col text-primary">{{ $itemInfo['ean'] }}</div>
        <div class="row">Quantity</div>
        @if ($itemInfo['available_quantity'] == 0)
            <div class="col text-primary">{{ '0' }}</div>
        @else
            <div class="col text-primary">{{ $itemInfo['available_quantity'] }}</div>
        @endif

        <div class="row">Price</div>
        <div class="col text-primary">€ {{ $itemInfo['prices']['list']['default'] }}</div>
        <div class="row">dimension</div>
        <div class="col text-primary">length : {{ $productInfo['dimensions']['product']['length'] }}
        </div>
        <div class="row">dimension</div>
        <div class="col text-primary">height : {{ $productInfo['dimensions']['product']['height'] }}
        </div>
        <div class="row">dimension</div>
        <div class="col text-primary">width : {{ $productInfo['dimensions']['product']['width'] }}
        </div>
        <div class="row">Dettagli</div>

        @if (isset($productInfo['features']['Parti metalliche']))
            <div class="row ms-1">Parti metalliche</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Parti metalliche'] as $key => $parti)
                    {{ $parti }}<br />
                @endforeach
            </div>
        @endif

        @if (isset($productInfo['features']['Tipologia']))
            <div class="row ms-1">Tipologia</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Tipologia'] as $key => $tip)
                    {{ $tip }}<br />
                @endforeach

            </div>
        @endif

        @if (isset($productInfo['features']['Composizione']))
            <div class="row ms-1">Composizione</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Composizione'] as $key => $comp)
                    {{ $comp }}<br />
                @endforeach
            </div>
        @endif

        @if (isset($productInfo['features']['Descrizione esterna']))
            <div class="row ms-1">Descrizione esterna</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Descrizione esterna'] as $key => $desc)
                    {{ $desc }}<br />
                @endforeach
            </div>
        @endif

        @if (isset($productInfo['features']['Accessori']))
            <div class="row ms-1">Accessori</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Accessori'] as $key => $accessori)
                    {{ $accessori }}<br />
                @endforeach
            </div>
        @endif

        @if (isset($productInfo['features']['Descrizione interni']))
            <div class="row ms-1">Descrizione interni</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Descrizione interni'] as $key => $descInt)
                    {{ $descInt }}<br />
                @endforeach
            </div>
        @endif

        @if (isset($productInfo['features']['Caratteristiche']))
            <div class="row ms-1">Caratteristiche</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Caratteristiche'] as $key => $descInt)
                    {{ $descInt }}<br />
                @endforeach
            </div>
        @endif

        @if (isset($productInfo['features']['Chiusura']))
            <div class="row ms-1">Chiusura</div>
            <div class="col text-primary ms-3">
                @foreach ($productInfo['features']['Chiusura'] as $key => $chiusura)
                    {{ $chiusura }}<br />
                @endforeach
            </div>
        @endif

        {{-- <div class="row ms-1">items</div>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][0]['sku'] }}</div>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][0]['details_endpoint'] }}</div>
        <hr>
        </hr>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][1]['sku'] }}</div>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][1]['details_endpoint'] }}</div>
        <hr>
        </hr>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][2]['sku'] }}</div>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][2]['details_endpoint'] }}</div>
        <hr>
        </hr>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][3]['sku'] }}</div>
        <div class="col text-primary ms-3">{{ $response['productDetails']['items'][3]['details_endpoint'] }}</div>
        <hr>
        </hr> --}}
    </div>

</body>

</html>
