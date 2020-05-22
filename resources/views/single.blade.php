@extends('layouts.front')

@section('content')
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots">
                                <ul class="slick3-dots" role="tablist" style="">
                                    <li class="slick-active" role="presentation"><img src="http://127.0.0.1:8001/storage/products/kj3E5T4QxBwQocqs098flkTPDEuBM8l9jz637uH0.jpeg ">
                                        <div class="slick3-dot-overlay"></div>
                                    </li>
                                    <li role="presentation"><img src="http://127.0.0.1:8001/storage/products/kj3E5T4QxBwQocqs098flkTPDEuBM8l9jz637uH0.jpeg ">
                                        <div class="slick3-dot-overlay"></div>
                                    </li>
                                    <li role="presentation"><img src=" http://127.0.0.1:8001/storage/products/kj3E5T4QxBwQocqs098flkTPDEuBM8l9jz637uH0.jpeg ">
                                        <div class="slick3-dot-overlay"></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"><button class="arrow-slick3 prev-slick3 slick-arrow"
                                                                                     style=""><i class="fa fa-angle-left" aria-hidden="true"></i></button><button
                                    class="arrow-slick3 next-slick3 slick-arrow" style=""><i class="fa fa-angle-right"
                                                                                             aria-hidden="true"></i></button></div>

                            <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                                <div class="slick-list draggable">
                                    <div class="slick-track" style="opacity: 1; width: 1062px;">
                                        <div class="item-slick3 slick-slide slick-current slick-active"
                                             data-thumb="images/product-detail-01.jpg" data-slick-index="0" aria-hidden="false" tabindex="0"
                                             role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10"
                                             style="width: 354px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                            <div class="wrap-pic-w pos-relative">
                                                @if($product->photos->count())
                                                    <img src="{{asset('storage/'.$product->photos->first()->image)}}" alt="" class="card-img-top" style="width: 300px">

                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                       href="images/product-detail-01.jpg" tabindex="0">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                            </div>
                                        </div>
                                        @else
                                            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                                        @endif



                                        <div class="item-slick3 slick-slide" data-thumb="images/product-detail-02.jpg" data-slick-index="1"
                                             aria-hidden="true" tabindex="-1" role="tabpanel" id="slick-slide11"
                                             aria-describedby="slick-slide-control11"
                                             style="width: 354px; position: relative; left: -354px; top: 0px; z-index: 998; opacity: 0;">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                   href="images/product-detail-02.jpg" tabindex="-1">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item-slick3 slick-slide" data-thumb="images/product-detail-03.jpg" data-slick-index="2"
                                             aria-hidden="true" tabindex="-1" role="tabpanel" id="slick-slide12"
                                             aria-describedby="slick-slide-control12"
                                             style="width: 354px; position: relative; left: -708px; top: 0px; z-index: 998; opacity: 0;">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                   href="images/product-detail-03.jpg" tabindex="-1">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>
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
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 select2-hidden-accessible" name="time" tabindex="-1" aria-hidden="true">
                                            <option>Choose an option</option>
                                            <option>Size S</option>
                                            <option>Size M</option>
                                            <option>Size L</option>
                                            <option>Size XL</option>
                                        </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                                       style="width: 140px;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true"
                                                    aria-expanded="false" tabindex="0" aria-labelledby="select2-time-mg-container"><span
                                                        class="select2-selection__rendered" id="select2-time-mg-container"
                                                        title="Choose an option">Choose an option</span><span class="select2-selection__arrow"
                                                                                                              role="presentation"><b role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 select2-hidden-accessible" name="time" tabindex="-1" aria-hidden="true">
                                            <option>Choose an option</option>
                                            <option>Red</option>
                                            <option>Blue</option>
                                            <option>White</option>
                                            <option>Grey</option>
                                        </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                                       style="width: 140px;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true"
                                                    aria-expanded="false" tabindex="0" aria-labelledby="select2-time-2l-container"><span
                                                        class="select2-selection__rendered" id="select2-time-2l-container"
                                                        title="Choose an option">Choose an option</span><span class="select2-selection__arrow"
                                                                                                              role="presentation"><b role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                   data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                               data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
