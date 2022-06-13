@extends('app')
@section('title', "$products_info->code")

@section('content')

<div class="col-md-6 ">
    <table class="table table-primary table-striped mt-5">
        <thead>
            <tr>
            <th scope="col">#ID</th>
            <th scope="col">Item</th>
            <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{$products_info->code}}</th>
                <td>{{$products_info->giftwrap_type}}</td>
            </tr>
        </tbody>
    </table>
<div class="col-md-2">
    @foreach ($products_info->items as $item )
    <p><a href=" #{{-- {{ url('/itemInfo'.$item->details_endpoint) }} --}}">{{ $item->sku }}</a></p>
    @endforeach
</div>     

</div>

</div>
</div>

@endsection
