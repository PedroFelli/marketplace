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
                                <div class="size-203 flex-c-m respon6">
                                    Tamanho
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2"  name="product[size]">
                                            <option>Selecione a opção</option>
                                            <option>Size P</option>
                                            <option>Size M</option>
                                            <option>Size G</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Cor
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2"  name="product[color]">
                                            <option>Selecione a opção</option>
                                            <option>Red</option>
                                            <option>Blue</option>
                                            <option>White</option>
                                            <option>Grey</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">

                                    <div class="product-add col-md-12">

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
                                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                                Adicionar ao carrinho
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection


