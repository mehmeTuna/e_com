<header class="header-section">
    <div class="header-top">
        <div class="container">
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
            <div class="ht-right">
                @if(session('userId', false))
                    <a href="/cikis-yap" class="login-panel"><i class="fa fa-user"></i>Çıkış Yap</a>
                    @else
                    <a href="/giris" class="login-panel"><i class="fa fa-user"></i>Giriş Yap</a>
                    @endif

                <div class="top-social">
                    @if(session('userId', false))
                        <a href="/hesabim" ><i class="fa fa-user"></i>Hesabim</a>

                    @endif
                </div>

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
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="/">
                            <img src="{{$logoUrl}}" alt="{{$siteData->name}}">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <div class="input-group">
                            <input type="text" id="searchValue" placeholder="Ara">
                            <button type="button" onclick="search()"><i class="ti-search"></i></button>
                        </div>
                        <script>
                          function search(){
                            const value = document.getElementById('searchValue').value.trim()
                            if(value.length > 3){
                              window.location.href = `/ara/${value}`
                            }
                          }
                        </script>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="cart-icon">
                            <a href="/sepet">
                                <i class="icon_bag_alt"></i>
                                <span>{{$cartCount}}</span>
                            </a>
                           <!--
                            <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody>
                                        @foreach($cartItems as $value)
                            @if(count($value['options']['selectBox']) > 0)
                                @foreach($value['options']['selectBox'] as $selectBox)
                                    @foreach($selectBox as $item)
                                        <tr>
                                            <td class="si-pic">
                                                <img src="{{$value['name']}}" alt="{{$value['name']}}">
                                                            </td>
                                                            <td class="si-text">
                                                                <div class="product-selected">
                                                                    <p>{{$value['price']}} x {{$item['name']}}</p>
                                                                    <h6>{{$value['name']}}</h6>
                                                                </div>
                                                            </td>
                                                            <td class="si-close">
                                                                <i class="ti-close"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                @endforeach
                            @endif
                            @if(count($value['options']['checkBox']) > 0)
                                @foreach($value['options']['checkBox'] as $selectBox)
                                    @foreach($selectBox as $item)
                                        <tr>
                                            <td class="si-pic">
                                                <img src="{{$value['name']}}" alt="{{$value['name']}}">
                                                            </td>
                                                            <td class="si-text">
                                                                <div class="product-selected">
                                                                    <p>{{$value['price']}} x {{$item['name']}}</p>
                                                                    <h6>{{$value['name']}}</h6>
                                                                </div>
                                                            </td>
                                                            <td class="si-close">
                                                                <i class="ti-close"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                @endforeach
                            @endif
                            @if($value['quantity'] > 0)
                                <tr>
                                    <td class="si-pic">
                                        <img src="{{$value['img']}}" alt="{{$value['name']}}">
                                                    </td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>{{$value['price']}} x </p>
                                                            <h6>{{$value['name']}}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>
                                            @endif
                        @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="select-total">
                            <span>Toplam:</span>
                            <h5>{{$cartTotal}}</h5>
                                </div>
                                <div class="select-button">
                                    <a href="/sepet" class="primary-btn view-card">Sepete Git</a>
                                </div>
                            </div>
-->
                        </li>
                        <li class="cart-price">{{$cartTotal}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>Kategoriler</span>
                    <ul class="depart-hover">
                        @foreach($categories as $value)
                            <li class=""><a href="{{$value->slug}}">{{$value->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
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
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>