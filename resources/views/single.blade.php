@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-6">
            @if($product->photos->count())
                <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" class="card-img-top" style="width: 300px">
                <div class="row" style="margin-top: 20px">
                    @foreach($product->photos as $photo)
                        <div class="col-2">
                            <img src="{{asset('storage/'.$photo->image)}}" alt="" class="img-fluid">
                        </div>
                    @endforeach
                </div>
                @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
            @endif
        </div>
        <div class="col-6">
            <div cclass ol-md-12>
                <h2>{{$product->name}}</h2>
                <p>
                    {{$product->description}}
                </p>

                <h3>
                    R${{number_format($product->price, '2', ',', '.')}}
                </h3>

                <span>
                Loja: {{$product->store->name}}
            </span>
            </div>

            <div class="product-add col-md-12">
                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="text" name="product[name]" value="{{$product->name}}" hidden>
                    <input type="text" name="product[price]" value="{{$product->price}}" hidden>
                    <input type="text" name="product[slug]"  value="{{$product->slug}}" hidden>
                    <div class="form-group">
                        <label>Quandidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            {{$product->body}}
        </div>

    </div>

@endsection
