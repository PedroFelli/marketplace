@extends('layouts.front')

@section('content')
    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            @if($product->photos->count())
                                <div class="wrap-slick3-dots">
                                </div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                                <div class="slick3 gallery-lb">
                                    @foreach($product->photos as $photo)
                                        <div class="item-slick3" data-thumb="{{asset('storage/'.$photo->image)}}">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="{{asset('storage/'.$photo->image)}}" alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('storage/'.$photo->image)}}">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            @else
                                <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                            @endif


                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{$product->name}}
                        </h4>

                        <span class="mtext-106 cl2">
							 R${{number_format($product->price, '2', ',', '.')}}
						</span>

                        <p class="stext-102 cl3 p-t-23">
                            {{$product->body}}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <form action="{{route('cart.add')}}" method="post">
                                @csrf
                                <div class="flex-w flex-r-m p-b-10">
                                    @if(!$sizes)
                                        <p style="text-align: center;font-weight: bold; font-size: 16px; color: red;"> Produto indisponível
                                        @error('size')
                                         , você não pode adicionar um produto fora de estoque no carrinho.</p>
                                        @enderror
                                    @else
                                    <div class="size-203 flex-c-m respon6">
                                        Tamanho
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2"  id="productSize"  name="size" onchange="sizeSelect(event)">
                                                <option selected disabled>Selecione o tamanho</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{$size->id}}"
                                                            @if(!$product->sizes->contains($size))
                                                            disabled @endif>{{$size->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        @error('size')
                                        <span style="color: red"> <strong>{{$message}}</strong></span>
                                        @enderror
                                        @endif
                                    </div>

                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    @if(!$colors)


                                    @else
                                        <div class="size-203 flex-c-m respon6">
                                            Cor
                                        </div>

                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <select class="js-select2" id="productColor" name="color" onchange="colorSelect(event)">
                                                    <option selected disabled>Selecione a cor</option>
                                                    @foreach($colors as $color)
                                                        <option value="{{$color->id}}"
                                                                @if(!$product->colors->contains($color))
                                                                disabled @endif>{{$color->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                            @error('color')
                                            <span style="color: red"> <strong>{{$message}}</strong></span>
                                            @enderror
                                            @endif
                                        </div>
                                </div>


                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">

                                    <div class="product-add col-md-12">

                                        @if($product->photos->count())
                                            <input type="text" name="product[photo]" value="{{$product->photos->first()->image}}" hidden>
                                        @else
                                            <input type="text" name="product[photo]" value="{{asset('assets/img/no-photo.jpg')}}" hidden>
                                        @endif
                                            <input type="text" id="colorInput" name="product[color]" value="" hidden>
                                            <input type="text" id="sizeInput" name="product[size]" value="" hidden>
                                            <input type="text" name="product[name]" value="{{$product->name}}" hidden>
                                            <input type="text" name="product[price]" value="{{$product->price}}" hidden>
                                            <input type="text" name="product[slug]"  value="{{$product->slug}}" hidden>
                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="product[amount]"value="1">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                            @if($sizes)
                                                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                                    Adicionar ao carrinho
                                                </button>
                                            @endif
                                        </div>
                                </div>
                            </div>
                                    </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection

<script>
    function colorSelect(e) {
        document.getElementById("colorInput").value = document.getElementById("productColor").value = e.target.value;
    }
    function sizeSelect(e) {
        document.getElementById("colorInput").value = document.getElementById("sizeInput").value = e.target.value;
    }

</script>


