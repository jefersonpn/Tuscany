<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $items['product_code'] }} - {{ $items['color'] }} </title>
</head>

<body>
    <div class="container ms-2 mt-5">
        {{-- @php dd( $items ) ; @endphp --}}
        <div class="row">
            <h3>Code</h3>
        </div>
        <div class="col text-primary">
            <h2>{{ $items['product_code'] }}</h2>
        </div>
        <div class="row">Name</div>
        <div class="col text-primary">{{ $items['name'] }}</div>
        <div class="row">Color</div>
        <div class="col text-primary">
            <h4>{{ $items['color'] }} </h4>
        </div>
        <div class="row">EAN</div>
        <div class="col text-primary"> {{ $items['ean'] }} </div>
        <div class="row">Quantity</div>
        @if ($items['available_quantity'] == 0)
            <div class="col text-primary">Out of Stock</div>
        @else
            <div class="col text-primary">{{ $items['available_quantity'] }}</div>
        @endif

        <div class="row">Price</div>
        <div class="col text-primary">€ {{ $items['prices']['list']['default'] }}</div>
    </div>

</body>

</html>
