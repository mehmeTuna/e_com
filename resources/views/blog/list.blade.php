<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

@component('label.head')

@endcomponent

<body>

    <!-- Header Section Begin -->
    @component('label.header')
    @endcomponent
    <!-- Header End -->


    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                   
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        @foreach($articles as $article)
                            <div class="col-lg-6 col-sm-6">
                                <div class="blog-item">
                                    <div class="bi-pic">
                                        <img style='width: auto; max-height: 150px;' src="{{$article->img}}" alt="">
                                    </div>
                                    <div class="bi-text">
                                        <a href="/icerik/{{$article->url}}">
                                            <h4>{{$article->title}}</h4>
                                        </a>
                                        <p><span>{{$article->created_at}}</span></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->


    <!-- Footer Section Begin -->
    @component('label.footer')

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