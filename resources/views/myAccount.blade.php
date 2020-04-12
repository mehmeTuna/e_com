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



<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact-title">
                    <h4>{{$user->firstname}} {{$user->lastname}}</h4>
                    <p>bilgilerinizi guncellemek icin uzerine tiklayiniz</p>
                </div>
                <div class="contact-widget">
                    <div class="cw-item" style="cursor: pointer" onclick="addressUpdate()">
                        <div class="ci-icon">
                            <i class="ti-location-pin"></i>
                        </div>
                        <div class="ci-text">
                            <span>Adres:</span>
                            <p>{{$user->adress == '' ? 'Adres Ekleyiniz' : $user->adress}}</p>
                        </div>
                    </div>
                    <div class="cw-item" style="cursor: pointer" onclick="phoneUpdate()">
                        <div class="ci-icon">
                            <i class="ti-mobile"></i>
                        </div>
                        <div class="ci-text">
                            <span>Telefon:</span>
                            <p>{{$user->phone == '' ? 'Iletisim bilgisi ekleyiniz' : $user->phone}}</p>
                        </div>
                    </div>
                    <div class="cw-item" style="cursor: pointer" onclick="emailUpdate()">
                        <div class="ci-icon">
                            <i class="ti-email"></i>
                        </div>
                        <div class="ci-text">
                            <span>Email:</span>
                            <p>{{$user->email == '' ? 'Email ekleyiniz' : $user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="contact-form">
                    <div class="leave-comment">
                        <h4>Siparisiniz bulunmamaktadir</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function addressUpdate(){
      swal({
        text: 'Yeni adresinizi giriniz',
        content: "input",
        button: {
          text: "Guncelle",
          closeModal: false,
        },
      })
      .then(name => {
        if (!name || name.trim() === '') return;

        return axios.post('/user/update',{
          adress: name.trim()
        }).then(function (response) {
          return response
        })
      })
      .then(results => {
        window.location.reload()
      });
    }
    function phoneUpdate(){
      swal({
        text: 'Yeni iletisim bilgisi giriniz',
        content: "input",
        button: {
          text: "Guncelle",
          closeModal: false,
        },
      })
      .then(name => {
        if (!name || name.trim() === '') return;

        return axios.post('/user/update',{
          phone: name.trim()
        }).then(function (response) {
          return response
        })
      })
      .then(results => {
        window.location.reload()
      });
    }
    function emailUpdate(){
      swal({
        text: 'Yeni email adresinizi giriniz',
        content: "input",
        button: {
          text: "Guncelle",
          closeModal: false,
        },
      })
      .then(name => {
        if (!name || name.trim() === '') return;

        return axios.post('/user/update',{
          email: name.trim()
        }).then(function (response) {
          console.log(response.data)
        })
      })
      .then(results => {
        window.location.reload()
      });
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
