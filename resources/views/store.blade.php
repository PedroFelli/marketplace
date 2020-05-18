@extends('layouts.front')

@section('content')

<div class="row front">
    <div class="col-4">
        @if($store->logo)
            <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da loja{{$store->name}}" class="img-fluid">
                @else
                    <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Loja sem logo" class="img-fluid">
                @endif
            </div>
            <div class="col-8">
                <h2>{{$store->name}}</h2>
                <p>{{$store->description}}</p>
                <p>
                    <strong>Contatos:</strong>
                    <span>{{$store->phone}}</span> || <span>{{$store->mobile_phone}}</span>
                </p>
            </div>
    <div class="col-12">
        <hr>
        <h3 style="margin-bottom: 30px">Produtos dessa loja</h3>
    </div>
        @forelse($store->products as $key => $product)
            <div class="col-md-4">
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
                </div>
        @empty
           <div class="col-12">
               <h3 class="alert alert-warning">
                   Nenhum produto encontrado para essa loja
               </h3>
           </div>

        @endforelse


</div>

@endsection
