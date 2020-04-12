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
                        <a href="/">Ürün</a>
                        <span>Detay</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="filter-widget">
                        <h4 class="fw-title">Kategoriler</h4>
                        <ul class="filter-catagories">
                            @foreach($categories as $value)
                            <li><a href="{{$value->slug}}">{{$value->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Size</h4>
                        <div class="fw-size-choose">
                            <div class="sc-item">
                                <input type="radio" id="s-size">
                                <label for="s-size">s</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="m-size">
                                <label for="m-size">m</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="l-size">
                                <label for="l-size">l</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="xs-size">
                                <label for="xs-size">xs</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{$product->img}}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach($product->otherImg as $value)
                                    <div class="pt active" data-imgbigurl="{{$value}}"><img src="{{$value}}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$productCategory->name}}</span>
                                    <h3>{{$product->name}}</h3>
                                    <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                </div>
                                <div class="pd-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>(5)</span>
                                </div>
                                <div class="pd-desc">
                                    <p>{{$product->content}}</p>
                                    <h4 id='price'>{{$product->price}}</h4>
                                </div>
                                <!--
                             <div class="pd-color">
                                <h6>Color</h6>
                                <div class="pd-color-choose">
                                    <div class="cc-item">
                                        <input type="radio" id="cc-black">
                                        <label for="cc-black"></label>
                                    </div>
                                    <div class="cc-item">
                                        <input type="radio" id="cc-yellow">
                                        <label for="cc-yellow" class="cc-yellow"></label>
                                    </div>
                                    <div class="cc-item">
                                        <input type="radio" id="cc-violet">
                                        <label for="cc-violet" class="cc-violet"></label>
                                    </div>
                                </div>
                            </div>
                            -->
                                <form action="#">
                                    <div class="pd-size-choose">
                                        <label>
                                            @foreach($features as $value)
                                            @if($value->type == 'selectBox')
                                            <div class="sc-item">
                                                <input type="radio" name="selectBox" value="{{$value->id}}">
                                                <label for="md-size" class="labelSelectBox" data-type='selectBox'
                                                    data-value="{{$value->id}}"
                                                    data-price="{{$value->price}}">{{$value->name}}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                        </label>
                                    </div>
                                    <div class="pd-size-choose">
                                        <label>
                                            @foreach($features as $value)
                                            @if($value->type == 'checkBox')
                                            <div class="sc-item">
                                                <input type="radio" name="checkBox" value="{{$value->id}}">
                                                <label for="sm-size" class="labelCheckBox" data-type='checkBox'
                                                    data-value="{{$value->id}}"
                                                    data-price="{{$value->price}}">{{$value->name}}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                        </label>
                                    </div>
                                </form>
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" id="productQty" value="{{$product->minorders}}">
                                    </div>
                                    <span style="cursor: pointer" class="primary-btn pd-cart" onclick="addItem()">Sepete
                                        Ekle</span>
                                </div>
                                <ul class="pd-tags">
                                    <li><span>Kategori</span>: {{$product->category->name}}</li>
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">Ürün Kodu: {{$product->code}}</div>
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">Ürün Detay</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">Ürün Hakkında</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Teslimat</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <h5></h5>
                                                {{$product->content}}
                                            </div>
                                            <div class="col-lg-5">
                                                <img src="{{$product->img}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <span>(5)</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">$495.00</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Add To Cart</td>
                                                <td>
                                                    <div class="cart-add">+ add to cart</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock">22 in stock</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Weight</td>
                                                <td>
                                                    <div class="p-weight">1,3kg</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Size</td>
                                                <td>
                                                    <div class="p-size">Xxl</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Color</td>
                                                <td><span class="cs-color"></span></td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Sku</td>
                                                <td>
                                                    <div class="p-code">00012</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        {{$product->delivery}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sana Özel</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($otherProducts as $value)
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{$product->img}}" alt="">
                            <!-- <div class="sale">Sale</div>-->
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="{{$value->nameSlug}}">Ürünü İncele</a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$productCategory->name}}</div>
                            <a href="#">
                                <h5>{{$value->name}}</h5>
                            </a>
                            <div class="product-price">
                                {{$value->price}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->



    <!-- Footer Section Begin -->
    @component('label.footer',[
    'logoUrl' => $logoUrl,
    'siteData' => $siteData
    ])

    @endcomponent
    <!-- Footer Section End -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    var selectBoxData = '';
    var checkBoxData = '';
    var checkBoxPrice = {{$product->price}}

    var productId = {{$product->id}}
    var minOrders = {{$product->minorders}};
    var productPrice = {{$product->price}}
    var updatedPrice = productPrice
    var productQuantity = minOrders

    $(window).on('load', function() {
      priceUpdate()
        /*-------------------
         Radio Btn
         --------------------- */
        $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").on('click', function() {
            if (this.dataset.type === 'selectBox') {
                $(".fw-size-choose .sc-item .labelSelectBox, .pd-size-choose .sc-item .labelSelectBox")
                    .removeClass('active');
                selectBoxData = this.dataset.value;
            } else if (this.dataset.type === 'checkBox') {
                $(".fw-size-choose .sc-item .labelCheckBox, .pd-size-choose .sc-item .labelCheckBox")
                    .removeClass('active');
                checkBoxData = this.dataset.value;
              checkBoxPrice = this.dataset.price ;
              priceUpdate()
            }
            $(this).addClass('active');
        });


        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on('click', '.qtybtn', function() {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > minOrders) {
                    var newVal = parseFloat(oldValue) - 1
                } else {
                    newVal = minOrders;
                }
            }
          productQuantity = newVal
             priceUpdate()
            $button.parent().find('input').val(newVal);
        });
    });

    function addItem() {
        axios.post('/user/cart',{
            productId: productId,
            productQuantity: productQuantity,
            selectBox: selectBoxData,
            checkBox: checkBoxData

        })
        .then(function (response) {
        // handle success
        console.log(response.data);
        })
        .catch(function (error) {
        // handle error
        console.log(error);
        })
    }

    function priceUpdate(){
      if(checkBoxData !== ''){
        updatedPrice = productQuantity *  checkBoxPrice
      }else {
        updatedPrice = productQuantity *  productPrice
      }
      $('#price').html(updatedPrice);
    }
    </script>
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