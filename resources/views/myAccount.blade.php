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
    <div class="container d-flex">
        <div class="d-none d-md-block d-lg-block col-lg-3 col-md-4">
            <div class="d-flex flex-column justify-content-start">
                <div class="text-left btn p-2">
                    <p class="h5">Mehmet tuna</p>
                </div>
                <div class="text-left btn p-2">
                    <p class="h5">Uyelik Bilgilerim</p>
                </div>
                <div class="text-left btn p-2">
                    <p class="h5">Siparislerim</p>
                </div>
                <div class="text-left btn p-2">
                    <p class="h5">Iadelerim</p>
                </div>
                <div class="text-left btn p-2">
                    <p class="h5">Adreslerim</p>
                </div>
            </div>
        </div>
        <div class="flex-fill">
            <div class="d-flex">
                <div class="col-lg-6 col-12">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Adiniz</label>
                                <input type="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Soyadiniz</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="deneme@deneme.com">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Cep Telefonu</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="(000) 000 00 00">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Önemli kampanyalardan eposta ile haberdar olmak istiyorum.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Önemli kampanyalardan SMS ile haberdar olmak istiyorum.
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    sag taraf bilgiler icin aciklama gorebilecegi kisim
                </div>
            </div>
        </div>
        <!--
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

                        @if($orders == null)
        <h4>Siparisiniz bulunmamaktadir</h4>
@else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">siparis numarasi</th>
                <th scope="col">Urun</th>
                <th scope="col">ozellik</th>
                <th scope="col">Fiyat</th>
                <th scope="col">Tarih</th>
                <th scope="col">Durum</th>
            </tr>
            </thead>
            <tbody>
@foreach($orders as $value)
            <tr>
                <th scope="row">{{$value->id}}</th>
                                            <td>{{$value->product->name}}</td>
                                            <td>
                                                {{$value->selectbox != '' ? $value->selectbox->name : ''}}
            {{$value->checkbox != '' ? $value->checkbox->name : ''}}
                    </td>
                    <td>{{$value->price}}</td>
                                            <td>{{$value->date}}</td>
                                            <td>{{$value->durum}}</td>
                                        </tr>
                                    @endforeach
                </tbody>
            </table>
@endif
            </div>
        </div>
    </div>
</div>
-->
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
          window.location.reload()
        })
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
          window.location.reload()
        })
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
          window.location.reload()
        })
      });
    }
</script>

<!-- Footer Section Begin -->
@component('label.footer',[
  'logoUrl' => $logoUrl,
  'siteData' => $siteData,
  'brands' => $brands
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
