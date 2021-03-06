<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

@component('label.head')

@endcomponent

<body>

<!-- Header Section Begin -->
@component('label.header')

@endcomponent
<!-- Header End -->

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="/"><i class="fa fa-home"></i> AnaSayfa</a>
                    <a href="/giris">Giriş Yap</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->


<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">
                    <h2>Giriş Yap</h2>
                    <form action="/giris" method="post">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="group-input">
                            <label for="username">Email *</label>
                            <input type="text" id="username" name="username">
                        </div>
                        <div class="group-input">
                            <label for="pass">Parola *</label>
                            <input type="password" id="pass" name="password">
                        </div>
                        <button type="submit" class="site-btn register-btn">Giriş Yap </button>
                    </form>
                    <div class="switch-login">
                        <a href="/kayit-ol" class="or-login">Kayıt Ol</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->


<!-- Footer Section Begin -->
@component('label.footer')

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
