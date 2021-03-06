<header class="header-section">
    <div class="header-top">
        <div class='d-inline d-md-none d-lg-none d-xl-none'>
            <button type="button" class="btn">
             <img width='35px' height='35px' src='/public/front/open-menu.svg' >
            </button>
        </div>
        <div class="container d-flex justify-content-between">
           <div class='flex-fill d-flex justify-content-around d-inline d-md-none d-lg-none d-xl-none'>
            <a href="/">
                    <img src="{{$logoUrl}}" alt="{{$siteData->name}}" style='max-height:50px'>
            </a>
            </div>
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-phone"></i>
                    {{$siteData->email}}
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    {{$siteData->phone}}
                </div>
            </div>
            <div class="ht-right ">
                @if(session('userId', false))
                <a href="/cikis-yap" class="login-panel"><i class="fa fa-user"></i>Çıkış Yap</a>
                @else
                <a href="/giris" class="login-panel"><i class="fa fa-user"></i>Giriş Yap</a>
                @endif

                @if(session('userId', false))
                <div class="top-social">
                    <a href="/hesabim"><i class="fa fa-user"></i>Hesabım</a>
                </div>
                @endif


                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row my-2">
                <div class="d-none d-md-inline d-lg-inline d-xl-inline col-lg-2 col-md-2 col-2">
                    <div class="logo">
                        <a href="/">
                            <img src="{{$logoUrl}}" alt="{{$siteData->name}}" style='max-width:75px'>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7  col-10 d-flex align-items-center justify-content-center">
                    <div class="advanced-search w-100">
                        <div class="input-group">
                            <input type="text" id="searchValue" placeholder="Ara">
                            <button type="button" onclick="search()"><i class="ti-search"></i></button>
                        </div>
                        <script>
                        function search() {
                            const value = document.getElementById('searchValue').value.trim()
                            if (value.length > 3) {
                                window.location.href = `/ara/${value}`
                            }
                        }
                        </script>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3 col-2 d-flex justify-content-center align-items-center">
                    <ul class="nav-right text-center">
                        <li class="cart-icon">
                            <a href="/sepet">
                                <i class="icon_bag_alt"></i>
                                <span id="cart-count">{{$cartCount}}</span>
                            </a>
                        </li>
                        @if($cartCount > 0)
                        <li class="cart-price text-center mx-2" id="cart-total">{{$cartTotal}}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container-category mx-auto">
            <nav class="nav-menu mobile-menu">
                <ul>
                    @foreach($categories as $value)
                    <li><a href="{{$value->slug}}">{{$value->name}}</a>
                        @if($value->subCategory != (object)[])
                        <ul class="dropdown">
                            @foreach($value->subCategory as $value)
                            <li><a href="{{$value->slug}}">{{$value->name}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>

    
</header>