<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

@component('label.head')

@endcomponent

<body>

    <!-- Header Section Begin -->
    @component('label.header')
    @endcomponent
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            @foreach($siteData->slider as $value)
            <div class="single-hero-items set-bg" data-setbg="{{$value->url}}">

            </div>
            @endforeach

        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <div class="d-none d-md-inline d-lg-inline d-xl-inline banner-section spad">
        <div class="mt-2 mx-2 container-fluid">
            <div class="row flex-row flex-no-wrap">
                <div style='cursor:pointer'
                    class="banner-section-item col-sm-3 col-lg-2 d-flex align-items-center justify-content-center p-3 mb-1">
                    <i class="icon_bag_alt pr-2"></i>
                    Title
                </div>
                <div style='cursor:pointer'
                    class="banner-section-item col-sm-3 col-lg-2 d-flex align-items-center justify-content-center p-3 mb-1">
                    <i class="icon_bag_alt pr-2"></i>
                    Title
                </div>
                <div style='cursor:pointer'
                    class="banner-section-item col-sm-3 col-lg-2 d-flex align-items-center justify-content-center p-3 mb-1">
                    <i class="icon_bag_alt pr-2"></i>
                    Title
                </div>
                <div style='cursor:pointer'
                    class="banner-section-item col-sm-3 col-lg-2 d-flex align-items-center justify-content-center p-3 mb-1">
                    <i class="icon_bag_alt pr-2"></i>
                    Title
                </div>
                <div style='cursor:pointer'
                    class="banner-section-item d-none col-lg-2 d-lg-flex align-items-center justify-content-center">
                    <i class="icon_bag_alt pr-2"></i>
                    Title
                </div>
                <div style='cursor:pointer'
                    class="banner-section-item d-none col-lg-2 d-lg-flex align-items-center justify-content-center">
                    <i class="icon_bag_alt pr-2"></i>
                    Title
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!--  Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-control">
                        <ul>
                            <li class="active">Yeni Eklenenler</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach($yeniEklenenler as $value)
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{$value->img}}" alt="{{$value->name}}">
                                <div class="sale">Yeni</div>
                                <ul>
                                    <li class="w-icon active" onClick='addCartItem({{$value->id}})' style='cursor:pointer;'><i
                                            class="icon_bag_alt"></i></li>
                                    <li class="quick-view"><a href="{{$value->nameSlug}}">Urunu Incele</a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                           
                                <a href="#">
                                    <h5>{{$value->name}}</h5>
                                </a>
                                <div class="product-price">
                                    {{$value->price}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Banner Section End -->
    <!--  Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-control">
                        <ul>
                            <li class="active">Trendler</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach($yeniEklenenler as $value)
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{$value->img}}" alt="{{$value->name}}">
                                <div class="sale">Yeni</div>
                                <ul>
                                    <li class="w-icon active" onClick='addCartItem({{$value->id}})' style='cursor:pointer;'><i
                                            class="icon_bag_alt"></i></li>
                                    <li class="quick-view"><a href="{{$value->nameSlug}}">Urunu Incele</a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <a href="#">
                                    <h5>{{$value->name}}</h5>
                                </a>
                                <div class="product-price">
                                    {{$value->price}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Banner Section End -->
    <!--  Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-control">
                        <ul>
                            <li class="active">Ilginizi Cekebilir</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach($yeniEklenenler as $value)
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{$value->img}}" alt="{{$value->name}}">
                                <div class="sale">Yeni</div>
                                <ul>
                                        <li class="w-icon active" onClick='addCartItem({{$value->id}})' style='cursor:pointer;'><i class="icon_bag_alt"></i></li>
                                        <li class="quick-view"><a href="{{$value->nameSlug}}">Urunu Incele</a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <a href="#">
                                        <h5>{{$value->name}}</h5>
                                    </a>
                                    <div class="product-price">
                                        {{$value->price}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Banner Section End -->

    <!-- Deal Of The Week Section Begin-->
    <section class="deal-of-week set-bg spad" data-setbg="/public/front/img/time-bg.jpg">
        <div class="container">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                        consectetur adipisicing elit </p>
                    <div class="product-price">
                        $35.00
                        <span>/ HanBag</span>
                    </div>
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span>56</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span>12</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span>40</span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span>52</span>
                        <p>Secs</p>
                    </div>
                </div>
                <a href="#" class="primary-btn">Shop Now</a>
            </div>
        </div>
    </section>
    <!-- Deal Of The Week Section End -->


   

    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-blog">
                        <img src="/public/front/img/latest-1.jpg" alt="">
                        <div class="latest-text">
                            <div class="tag-list">
                                <div class="tag-item">
                                    <i class="fa fa-calendar-o"></i>
                                    May 4,2019
                                </div>
                                <div class="tag-item">
                                    <i class="fa fa-comment-o"></i>
                                    5
                                </div>
                            </div>
                            <a href="#">
                                <h4>The Best Street Style From London Fashion Week</h4>
                            </a>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-blog">
                        <img src="/public/front/img/latest-2.jpg" alt="">
                        <div class="latest-text">
                            <div class="tag-list">
                                <div class="tag-item">
                                    <i class="fa fa-calendar-o"></i>
                                    May 4,2019
                                </div>
                                <div class="tag-item">
                                    <i class="fa fa-comment-o"></i>
                                    5
                                </div>
                            </div>
                            <a href="#">
                                <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>
                            </a>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-blog">
                        <img src="/public/front/img/latest-3.jpg" alt="">
                        <div class="latest-text">
                            <div class="tag-list">
                                <div class="tag-item">
                                    <i class="fa fa-calendar-o"></i>
                                    May 4,2019
                                </div>
                                <div class="tag-item">
                                    <i class="fa fa-comment-o"></i>
                                    5
                                </div>
                            </div>
                            <a href="#">
                                <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>
                            </a>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="/public/front/img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Free Shipping</h6>
                                <p>For all order over 99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="/public/front/img/icon-2.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Delivery On Time</h6>
                                <p>If good have prolems</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="/public/front/img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Secure Payment</h6>
                                <p>100% secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

    <!-- Footer Section Begin -->
    @component('label.footer')

    @endcomponent
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="/public/front/js/jquery-3.3.1.min.js"></script>
    <script src="/public/front/js/bootstrap.min.js"></script>
    <script src="/public/front/js/jquery-ui.min.js"></script>
    <script src="/public/front/js/jquery.countdown.min.js"></script>
    <script src="/public/front/js/jquery.nice-select.min.js"></script>
    <script src="/public/front/js/jquery.zoom.min.js"></script>
    <script src="/public/front/js/jquery.dd.min.js"></script>
    <script src="/public/front/js/jquery.slicknav.js"></script>
    <script src="/public/front/js/owl.carousel.min.js"></script>
    <script src="/public/front/js/main.js"></script>
</body>
</html>