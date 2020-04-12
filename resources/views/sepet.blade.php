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
                    <span>Sepet</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->



<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th class="p-name">Urun</th>
                            <th>Tutar</th>
                            <th>Adet</th>
                            <th>Toplam</th>
                            <th><i class="ti-close"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $value)
                            <tr>
                                <td class="cart-pic first-row"><img src="{{$value['img']}}" alt="{{$value['name']}}"></td>
                                <td class="cart-title first-row">
                                    <h5>{{$value['quantity']}}  x {{$value['name']}}  </h5>
                                    <h5>
                                        @foreach($value['options']['selectBox'] as $selectBox)
                                            @foreach($selectBox as $item)
                                                {{$item['quantity']}} x {{$item['name']}} <br>
                                            @endforeach
                                        @endforeach
                                        @foreach($value['options']['checkBox'] as $selectBox)
                                            @foreach($selectBox as $item)
                                                {{$item['quantity']}} x {{$item['name']}} <br>
                                            @endforeach
                                        @endforeach
                                    </h5>
                                </td>
                                <td class="p-price first-row">{{$value['price']}}</td>
                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="{{$value['quantity']}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="p-price first-row">{{$value['price']}}</td>
                                <td class="close-td first-row"><i class="ti-close"></i></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Toplam <span>{{$cartTotal}}</span></li>
                                <li class="cart-total">Toplam <span>{{$cartTotal}}</span></li>
                            </ul>
                            <a href="#" class="proceed-btn">Odeme Yap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  $(window).on('load', function() {



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
    console.log('selectBox', selectBoxData)
    console.log('checkBoxData', checkBoxData)
    console.log('price', productPrice)
    console.log('product Quantity', productQuantity)
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


<!-- Footer Section Begin -->
@component('label.footer',[
'logoUrl' => $logoUrl,
'siteData' => $siteData
])

@endcomponent
<!-- Footer Section End -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


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