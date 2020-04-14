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
                    <a href="/kayit-ol">Kayıt Ol</a>
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
                    <h2>Kayıt Ol</h2>
                    <form action="/kayit-ol" method="post">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div class="group-input">
                            <label for="con-pass">Ad Soyad *</label>
                            <input type="text" id="con-pass" name="fullName">
                        </div>
                        <div class="group-input">
                            <label for="username">Email *</label>
                            <input type="text" id="username" name="username">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Telefon *</label>
                            <input type="text" id="con-pass" name="phone" onkeyup="this.value.replace(this.value=this.value.replace(/[^\d]/,''))">
                        </div>
                        <div class="group-input">
                            <label for="pass">Parola *</label>
                            <input type="password" id="pass" name="password">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Tekrar Parola *</label>
                            <input type="password" id="con-pass" name="re-password">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Adres *</label>
                            <input type="text" id="con-pass" name="address">
                        </div>
                        <div class="filter-widget">
                            <div class="fw-brand-check">
                                <div class="bc-item">
                                    <label for="bc-tommy">
                                        Sozlesme
                                        <input type="checkbox" id="bc-tommy" name="contract" value="true">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="site-btn register-btn">Kayıt Ol</button>
                    </form>
                    <div class="switch-login">
                        <a href="/giris" class="or-login">Giriş Yap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->


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
