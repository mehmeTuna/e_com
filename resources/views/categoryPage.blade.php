<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

@component('label.head')

@endcomponent

<body>

<!-- Header Section Begin -->
@component('label.header', [
'logoUrl' => $logoUrl,
'siteData' => $siteData,
'categories' => $categories,
'cartCount' => $cartCount,
'cartItems' => $cartItems,
'cartTotal' => $cartTotal
])

@endcomponent
<!-- Header End -->

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="/"><i class="fa fa-home"></i> AnaSayfa</a>
                    @if(isset($category))
                        <a href="/{{$category->nameSlug}}">{{$category->name}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->



<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <h4 class="fw-title">Kategoriler</h4>
                    <ul class="filter-catagories">
                        @foreach($categories as $value)
                            <li><a href="/{{$value->slug}}">{{$value->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Fiyat</h4>
                    <div class="filter-range-wrap">
                        <div class="range-slider">
                            <div class="price-input">
                                <input type="text" id="minamount">
                                <input type="text" id="maxamount">
                            </div>
                        </div>
                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                             data-min="1" data-max="1500">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                    </div>
                    <div style="cursor: pointer" class="filter-btn" onclick="addPriceFilter()">
                        Filtrele
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Filterele</h4>
                    <div class="fw-size-choose">
                        @foreach($features as $value)
                            <div class="sc-item">
                                <input type="radio" id="s-size">
                                <label for="s-size">
                                    <a class="filter-btn" href="?option={{$value->id}}">
                                        {{$value->name}}
                                    </a></label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <select class="sorting" onChange="productListFilter(this)">
                                    <option value="price=plus">Fiyata gore Artan</option>
                                    <option value="price=minus">Fiyata gore Azalan </option>
                                </select>
                                <select class="sorting">
                                    <option value="">Toplam: {{count($productItems)}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 text-right">
                            <p>Toplam {{count($productItems)}} adet urun bulundu</p>
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                        @if(count($productItems) == 0)
                            <h4 style="width: 100%" class="text-center ">Urun bulunamadi</h4>
                        @else
                            @foreach($productItems as $value)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img src="{{$value->img}}" alt="{{$value->name}}">
                                        <div class="icon">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                        <ul>
                                            <li class="w-icon active"><a href="/{{$value->nameSlug}}"><i class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a href="/{{$value->nameSlug}}">Urunu Incele</a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">{{$category->name}}</div>
                                        <a href="/{{$value->nameSlug}}">
                                            <h5>{{$value->name}}</h5>
                                        </a>
                                        <div class="product-price">
                                            {{$value->price}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->


<script>

    window.onload = function(){
        /*-------------------
         Range Slider
         --------------------- */
      var rangeSlider = $(".price-range"),
          minamount = $("#minamount"),
          maxamount = $("#maxamount"),
          minPrice = rangeSlider.data('min'),
          maxPrice = rangeSlider.data('max');
      rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
          minamount.val( ui.values[0]);
          maxamount.val( ui.values[1]);
        }
      });
      minamount.val( rangeSlider.slider("values", 0));
      maxamount.val( rangeSlider.slider("values", 1));
    }

    function productListFilter(data){
      window.location.href = `${window.location.pathname}?${data.value}`;
    }

    function addPriceFilter(){
      let minPrice = document.getElementById('minamount').value ;
      let maxPrice = document.getElementById('maxamount').value;
      window.location.href = `${window.location.pathname}?minPrice=${minPrice}&maxPrice=${maxPrice}`;
    }
</script>


<!-- Footer Section Begin -->
@component('label.footer',[
'logoUrl' => $logoUrl,
'siteData' => $siteData
])

@endcomponent
<!-- Footer Section End -->

<!-- Js Plugins -->
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