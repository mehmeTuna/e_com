<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
    <title>aStar</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="aStar Fashion Template Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/front/styles/bootstrap-4.1.3/bootstrap.css">
    <link href="/public/front/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/public/front/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/public/front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="/public/front/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="/public/front/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="/public/front/styles/responsive.css">

</head>

<body>

    <div class="super_container">

        <!-- Header -->

        <header class="header">
            <div class="header_content d-flex flex-row align-items-center justify-content-start">

                <!-- Hamburger -->
                <div class="hamburger menu_mm"><i class="fa fa-bars menu_mm" aria-hidden="true"></i></div>

                <!-- Logo -->
                <div class="header_logo">
                    <a href="/">
                        <img src="{{$logoUrl}}" alt="logo" >
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="header_nav">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        @foreach($menu as $value)
                            <li><a href="{{$value->url}}">{{$value->title}}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <!-- Header Extra -->
                <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                    <!-- Language -->
                    <div class="info_languages has_children">
                        <div class="language_flag"></div>
                        <div class="dropdown_text">
                            @if(app()->getLocale() == 'tr')
                              Türkçe
                            @else
                             English
                            @endif
                        </div>
                        <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

                        <!-- Language Dropdown Menu -->
                        <ul>
                            @if(app()->getLocale() == 'tr')
                                <li><a href="/en">
                                        <div class="language_flag"></div>
                                        <div class="dropdown_text">English</div>
                                    </a></li>
                            @else
                                <li><a href="/tr">
                                        <div class="language_flag"></div>
                                        <div class="dropdown_text">Türkçe</div>
                                    </a></li>
                            @endif
                        </ul>

                    </div>

                    <!-- Cart -->
                    <div class="cart d-flex flex-row align-items-center justify-content-start">
                        <div class="cart_icon"><a href="/sepetim">
                                <img src="/public/front/images/bag.png" alt="">
                                <div class="cart_num">{{session('cardCount', 0)}}</div>
                            </a></div>
                    </div>
                </div>

            </div>
        </header>

        <!-- Menu -->

        <div class="menu d-flex flex-column align-items-start justify-content-start menu_mm trans_400">
            <div class="menu_close_container">
                <div class="menu_close">
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="menu_top d-flex flex-row align-items-center justify-content-start">

                <!-- Language -->
                <div class="info_languages has_children">
                    <div class="language_flag"></div>
                    <div class="dropdown_text">
                        @if(app()->getLocale() == 'tr')
                            Türkçe
                        @else
                            English
                        @endif
                    </div>
                    <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

                    <!-- Language Dropdown Menu -->
                    <ul>
                        @if(app()->getLocale() == 'tr')
                            <li><a href="/en">
                                    <div class="language_flag"></div>
                                    <div class="dropdown_text">English</div>
                                </a></li>
                        @else
                            <li><a href="/tr">
                                    <div class="language_flag"></div>
                                    <div class="dropdown_text">Türkçe</div>
                                </a></li>
                        @endif
                    </ul>

                </div>

            </div>
            <div class="menu_search">
                <form action="#" class="header_search_form menu_mm">
                    <input type="search" class="search_input menu_mm" id="searchInput" placeholder="@lang('site.ara')" required="required">

                </form>
                <span
                    onclick="searching()"
                    class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                        <i class="fa fa-search menu_mm" aria-hidden="true"></i>
                </span>
                <script>
                    function searching(){
                      const value = document.getElementById('searchInput').value.trim()
                      if(value !== ''){
                        console.log('clicked')
                        window.location = `/ara?v=${value}`
                      }
                    }
                </script>
            </div>
            <nav class="menu_nav">
                <ul class="menu_mm">
                    @foreach($menu as $value)
                        <li class="menu_mm"><a href="{{$value->url}}">{{$value->title}}</a></li>
                    @endforeach
                </ul>
            </nav>
            <div class="menu_extra">
                <div class="menu_social">
                    <ul>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->

        <div class="sidebar">

            <!-- Info -->
            <div class="info">
                <div class="info_content d-flex flex-row align-items-center justify-content-start">

                    <!-- Language -->
                    <div class="info_languages has_children">
                        <div class="language_flag"></div>
                        <div class="dropdown_text">
                            @if(app()->getLocale() == 'tr')
                                Türkçe
                            @else
                                English
                            @endif
                        </div>
                        <div class="dropdown_arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div>

                        <!-- Language Dropdown Menu -->
                        <ul>
                            @if(app()->getLocale() == 'tr')
                                <li><a href="/en">
                                        <div class="language_flag"></div>
                                        <div class="dropdown_text">English</div>
                                    </a></li>
                            @else
                                <li><a href="/tr">
                                        <div class="language_flag"></div>
                                        <div class="dropdown_text">Türkçe</div>
                                    </a></li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>

            <!-- Logo -->
            <div class="sidebar_logo">
                <a href="/">
                    <img src="{{$logoUrl}}" alt="logo" >
                </a>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="sidebar_nav">
                <ul>
                    @foreach($menu as $value)
                        <li><a href="{{$value->url}}">{{$value->title}} <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                    @endforeach
                </ul>
            </nav>

            <!-- Search -->
            <div class="search">
                <form action="#" class="header_search_form menu_mm">
                    <input type="search" class="search_input menu_mm" id="searchInput" placeholder="@lang('site.ara')" required="required">
                    <span
                            onclick="searching()"
                            class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                            <i class="fa fa-search menu_mm" aria-hidden="true"></i>
                    </span>
                </form>
                <script>
                  function searching(){
                    const value = document.getElementById('searchInput').value.trim()
                    if(value !== ''){
                      console.log('clicked')
                      window.location = `/ara?v=${value}`
                    }
                  }
                </script>
            </div>


        </div>

        <!-- Home -->

        <div class="home">

            <!-- Home Slider -->
            <div class="home_slider_container">
                <div class="owl-carousel owl-theme home_slider">
                    <!-- Slide -->
                    @foreach($siteData->slider as $value )
                        <div class="owl-item">
                            <div class="background_image" style="background-image:url({{$value->url}})"></div>
                            <div class="home_content_container">
                                <div class="home_content">
                                    <!--
                                    <div class="home_discount d-flex flex-row align-items-end justify-content-start">
                                        <div class="home_discount_num">20</div>
                                        <div class="home_discount_text">Discount on the</div>
                                    </div>
                                    <div class="home_title">New Collection</div>
                                    <div class="button button_1 home_button trans_200"><a href="categories.html">Shop
                                            NOW!</a></div>
                                    -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Home Slider Navigation -->
                <div class="home_slider_nav home_slider_prev trans_200">
                    <div class=" d-flex flex-column align-items-center justify-content-center"><img
                            src="/public/front/images/prev.png" alt=""></div>
                </div>
                <div class="home_slider_nav home_slider_next trans_200">
                    <div class=" d-flex flex-column align-items-center justify-content-center"><img
                            src="/public/front/images/next.png" alt=""></div>
                </div>

            </div>
        </div>

        <!-- Boxes -->

        <div class="boxes">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        @foreach($category as $value)
                            <!-- Box -->
                            <div class="col-lg-4 box_col">
                                <div class="box">
                                    <div class="box_image"><img src="{{$value->img}}" alt=""></div>
                                    <div class="box_title trans_200"><a href="{{$value->nameSlug}}"> {{$value->name}}</a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->

        <div class="categories">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="categories_list_container">
                                <ul class="categories_list d-flex flex-row align-items-center justify-content-start">
                                    <li><a href="categories.html">new arrivals</a></li>
                                    <li><a href="categories.html">recommended</a></li>
                                    <li><a href="categories.html">best sellers</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products -->

        <div class="products">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="products_container grid">

                                @foreach($products as $value)
                                <!-- Product -->
                                <div class="product grid-item hot">
                                    <div class="product_inner">
                                        <div class="product_image">
                                            <img src="{{$value->img}}" alt="{{$value->name}}">
                                            <div class="product_tag">hot</div>
                                        </div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="{{$value->nameSlug}}">{{$value->name}}</a></div>
                                            <div class="product_price">{{$value->price}}</div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="{{$value->nameSlug}}">Urunu Incele</a></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                                <!-- Product -->
                                <div class="product grid-item sale">
                                    <div class="product_inner">
                                        <div class="product_image">
                                            <img src="/public/front/images/product_3.jpg" alt="">
                                            <div class="product_tag">sale</div>
                                        </div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="product.html">long sleeve jacket</a>
                                            </div>
                                            <div class="product_price">$32.20<span>RRP 64.40</span></div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="#">add to
                                                    cart</a></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter -->

        <div class="newsletter">
            <div class="parallax_background parallax-window" data-parallax="scroll"
                 data-image-src="/public/front/images/newsletter.jpg" data-speed="0.8"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="newsletter_content text-center">
                            <div class="newsletter_title_container">
                                <div class="newsletter_title">subscribe to our newsletter</div>
                                <div class="newsletter_subtitle">we won't spam, we promise!</div>
                            </div>
                            <div class="newsletter_form_container">
                                <form action="#" id="newsletter_form" class="newsletter_form">
                                    <input type="email" class="newsletter_input" placeholder="your e-mail here"
                                           required="required">
                                    <button class="newsletter_button">submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->

        <footer class="footer">
            <div class="footer_content">
                <div class="section_container">
                    <div class="container">
                        <div class="row">

                            <!-- About -->
                            <div class="col-xxl-3 col-md-6 footer_col">
                                <div class="footer_about">
                                    <!-- Logo -->
                                    <div class="footer_logo">
                                        <a href="/">
                                            <img src="{{$logoUrl}}" alt="logo" >
                                        </a>
                                    </div>
                                    <div class="footer_about_text">
                                        <p> {{$siteData->description}}</p>
                                    </div>
                                    <div class="cards">
                                        <ul class="d-flex flex-row align-items-center justify-content-start">
                                            <li><a href="#"><img src="/public/front/images/card_1.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="/public/front/images/card_2.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="/public/front/images/card_3.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="/public/front/images/card_4.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="/public/front/images/card_5.jpg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Questions -->
                            <div class="col-xxl-3 col-md-6 footer_col">
                                <div class="footer_questions">
                                    <div class="footer_title">questions</div>
                                    <div class="footer_list">
                                        <ul>
                                            <li><a href="#">About us</a></li>
                                            <li><a href="#">Track Orders</a></li>
                                            <li><a href="#">Returns</a></li>
                                            <li><a href="#">Jobs</a></li>
                                            <li><a href="#">Shipping</a></li>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="#">Partners</a></li>
                                            <li><a href="#">Bloggers</a></li>
                                            <li><a href="#">Support</a></li>
                                            <li><a href="#">Terms of Use</a></li>
                                            <li><a href="#">Press</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog -->
                            <div class="col-xxl-3 col-md-6 footer_col">
                                <div class="footer_blog">
                                    <div class="footer_title">blog</div>
                                    <div class="footer_blog_container">

                                        <!-- Blog Item -->
                                        <div
                                            class="footer_blog_item d-flex flex-row align-items-start justify-content-start">
                                            <div class="footer_blog_image"><a href="blog.html"><img
                                                        src="/public/front/images/footer_blog_1.jpg" alt=""></a></div>
                                            <div class="footer_blog_content">
                                                <div class="footer_blog_title"><a href="blog.html">what shoes to
                                                        wear</a></div>
                                                <div class="footer_blog_date">june 06, 2018</div>
                                                <div class="footer_blog_link"><a href="blog.html">Read More</a></div>
                                            </div>
                                        </div>

                                        <!-- Blog Item -->
                                        <div
                                            class="footer_blog_item d-flex flex-row align-items-start justify-content-start">
                                            <div class="footer_blog_image"><a href="blog.html"><img
                                                        src="/public/front/images/footer_blog_2.jpg" alt=""></a></div>
                                            <div class="footer_blog_content">
                                                <div class="footer_blog_title"><a href="blog.html">trends this year</a>
                                                </div>
                                                <div class="footer_blog_date">june 06, 2018</div>
                                                <div class="footer_blog_link"><a href="blog.html">Read More</a></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="col-xxl-3 col-md-6 footer_col">
                                <div class="footer_contact">
                                    <div class="footer_title">@lang('site.iletisim')</div>
                                    <div class="footer_contact_list">
                                        <ul>
                                            <li class="d-flex flex-row align-items-start justify-content-start">
                                                <span>Phone</span>
                                                <div>{{$siteData->phone}}</div>
                                            </li>
                                            <li class="d-flex flex-row align-items-start justify-content-start">
                                                <span>Email:</span>
                                                <div>{{$siteData->email}}</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social -->
            <div class="footer_social">
                <div class="section_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div
                                    class="footer_social_container d-flex flex-row align-items-center justify-content-between">
                                    <!-- Instagram -->
                                    <a href="#">
                                        <div
                                            class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                                            <div class="footer_social_icon"><i class="fa fa-instagram"
                                                    aria-hidden="true"></i></div>
                                            <div class="footer_social_title">instagram</div>
                                        </div>
                                    </a>
                                    <!-- Facebook -->
                                    <a href="#">
                                        <div
                                            class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                                            <div class="footer_social_icon"><i class="fa fa-facebook"
                                                    aria-hidden="true"></i></div>
                                            <div class="footer_social_title">facebook</div>
                                        </div>
                                    </a>
                                    <!-- Twitter -->
                                    <a href="#">
                                        <div
                                            class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                                            <div class="footer_social_icon"><i class="fa fa-twitter"
                                                    aria-hidden="true"></i></div>
                                            <div class="footer_social_title">twitter</div>
                                        </div>
                                    </a>
                                    <!-- YouTube -->
                                    <a href="#">
                                        <div
                                            class="footer_social_item d-flex flex-row align-items-center justify-content-start">
                                            <div class="footer_social_icon"><i class="fa fa-youtube"
                                                    aria-hidden="true"></i></div>
                                            <div class="footer_social_title">youtube</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Credits -->
            <div class="credits">
                <div class="section_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="credits_content d-flex flex-row align-items-center justify-content-end">
                                    <div class="credits_text">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <script src="/public/front/js/jquery-3.2.1.min.js"></script>
    <script src="/public/front/styles/bootstrap-4.1.3/popper.js"></script>
    <script src="/public/front/styles/bootstrap-4.1.3/bootstrap.min.js"></script>
    <script src="/public/front/plugins/greensock/TweenMax.min.js"></script>
    <script src="/public/front/plugins/greensock/TimelineMax.min.js"></script>
    <script src="/public/front/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="/public/front/plugins/greensock/animation.gsap.min.js"></script>
    <script src="/public/front/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="/public/front/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="/public/front/plugins/easing/easing.js"></script>
    <script src="/public/front/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="/public/front/plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="/public/front/plugins/Isotope/fitcolumns.js"></script>
    <script src="/public/front/js/custom.js"></script>
</body>

</html>