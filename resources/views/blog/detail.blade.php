<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

@component('label.head')

@endcomponent

<body>

    <!-- Header Section Begin -->
    @component('label.header')
    @endcomponent
    <!-- Header End -->


    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-inner">
                        <div class="blog-detail-title">
                            <h2>{{$content->title}}</h2>
                            <p><span>{{$content->created_at}}</span></p>
                        </div>
                        <div class="blog-large-pic">
                            <img style='max-width: 100px; max-height: 100px;' src="{{$content->img}}" alt="">
                        </div>
                        <div class="blog-detail-desc">
                            <p>{{$content->content}}
                            </p>
                        </div>
                    
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->


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