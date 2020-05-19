<!-- Partner Logo Section Begin -->
<div class="partner-logo">
    <div class="container">
        <div class="logo-carousel owl-carousel">
            @foreach($brands as $value)
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{$value->img}}" alt="{{$value->name}}">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Partner Logo Section End -->

<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer-left">
                    <div class="footer-logo">
                        <a href="/"><img src="{{$logoUrl}}" alt="{{$siteData->name}}"></a>
                    </div>
                    <ul>
                        <li>Adres: {{$siteData->address}}</li>
                        <li>Telefon: {{$siteData->phone}}</li>
                        <li>Email: {{$siteData->email}}</li>
                    </ul>
                    <div class="footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <div class="footer-widget">
                    <h5>Destek</h5>
                    <ul>
                        <li><a href="/hakkimizda">Hakkımızda</a></li>
                        <li><a href="/iletisim">İletişim</a></li>
                        <li><a href="/icerik">İçeriklerimiz</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="footer-widget">
                    <h5>Hesabım</h5>
                    <ul>
                        <li><a href="/hesabim">Hesabım</a></li>
                        <li><a href="/iletisim">İletişim</a></li>
                        <li><a href="/sepet">Sepetim</a></li>
                        <li><a href="/">Alışverişe Başla</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="newslatter-item">
                    <h5>Bültene Kayıt Ol</h5>
                    <form action="#" class="subscribe-form">
                        <input type="text" placeholder="Email">
                        <button type="button">Kayıt Ol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-reserved">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                        </script> Tum Hakları Saklıdır
                    </div>
                    <div class="payment-pic">
                        <img src="/public/front/img/payment-method.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function addCartItem(productId) {
    axios.post('/user/cart', {
            productId: productId,
            productQuantity: 1
        })
        .then(function(response) {
            swal({
                text: 'Sepete Eklendi',
                timer: 1500
            }).then(() => window.location.href = '/sepet')
            // handle success
        })
}


</script>