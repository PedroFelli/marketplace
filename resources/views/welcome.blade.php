@extends('layouts.front')

@section('content')

<div class="row ">

        @foreach($products as $key => $product)
        <div class="col-md-4 front">
            <div class="card" style="width: 95%;">
                @if($product->photos->count())
                    <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" class="card-img-top">
                @else
                    <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <h2 class="clard-title">{{$product->name}}</h2>
                    <p class="clas-text">
                        {{$product->description}}
                    </p>
                    <h3>
                        R${{number_format($product->price, '2', ',', '.')}}
                    </h3>
                    <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
                        Ver Produto
                    </a>
                </div>
            </div>

        @if(($key + 1) % 3 == 0) </div> <div class="row "> <br>@endif

        </div>
        @endforeach
        <div class="row">
            <div class="col-12">
                <h2>Loja Destaque</h2>
                <hr>
            </div>
           @foreach($stores as $store)
                <div class="col-4">
                    @if($store->logo)
                        <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da loja{{$store->name}}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Loja sem logo" class="img-fluid">
                    @endif
                    <h3>{{$store->name}}</h3>
                    <p>{{$store->description}}</p>
                        <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
                </div>
            @endforeach
        </div>

</div>

@endsection
