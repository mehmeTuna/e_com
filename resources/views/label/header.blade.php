<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Escape Bar & Grill| Home</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/tooltipster.css">
    <link rel="stylesheet" href="/public/css/magnific-popup.css">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <!-- favicon -->
    <link rel="icon" href="favicon.ico">
</head>

<body>

    <main>
        <!--SOCIAL LINKS-->
        <aside>
            <a target="_blank" ; href="https://www.facebook.com/EscapeWorthing/">
                <svg x="0px" y="0px" width="150px" height="40px">
                    <polygon fill="#2d4c8b" points="150,40 7.001,40 0,33 0,7 6.918,0 150,0 " />
                    <image xlink:href="/public/images/facebook.png" x="23" y="10" width="9px" height="18px" />
                    <text x="55" y="24">Like Us!</text>
                </svg>
            </a>
            <a href="#">
                <svg x="0px" y="0px" width="150px" height="40px">
                    <polygon fill="#34dfe6" points="150,40 7.001,40 0,33 0,7 6.918,0 150,0 " />
                    <image xlink:href="/public/images/twitter.png" x="17" y="12" width="23px" height="16px" />
                    <text x="55" y="24">Follow Us!</text>
                </svg>
            </a>
            <a target="_blank" ; href="https://api.whatsapp.com/send?phone=0447827292641&text=Booking">
                <svg x="0px" y="0px" width="150px" height="40px">
                    <polygon fill="#e842ab" points="150,40 7.001,40 0,33 0,7 6.918,0 150,0 " />
                    <image xlink:href="/public/images/flickr.png" x="17" y="16" width="18px" height="7px" />
                    <text x="55" y="24">Booking Now</text>
                </svg>
            </a>
            <a href="#">
                <svg x="0px" y="0px" width="150px" height="40px">
                    <polygon fill="#ff9000" points="150,40 7.001,40 0,33 0,7 6.918,0 150,0 " />
                    <image xlink:href="/public/images/rss.png" x="18" y="12" width="16px" height="16px" />
                    <text x="55" y="24">Rss Feed</text>
                </svg>
            </a>
            <a href="#">
                <svg x="0px" y="0px" width="150px" height="40px">
                    <polygon fill="#33517f" points="150,40 7.001,40 0,33 0,7 6.918,0 150,0 " />
                    <image xlink:href="/public/images/vimeo.png" x="18" y="13" width="17px" height="15px" />
                    <text x="55" y="24">Vimeo</text>
                </svg>
            </a>
        </aside>
        <!--/SOCIAL LINKS-->

        <!--HEADER-->
        <header>
            <div id="main-nav-wrap">
                <nav id="main-nav">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <li class="sub-items"><a href="#">Features</a>
                            <ul>
                                <li><a href="index.php#about-wrap">About Us</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li><a target="_blank" ;
                                        href="https://api.whatsapp.com/send?phone=0447827292641&text=Booking">Booking
                                        Now</a></li>
                                <li><a href="index.php#map">Find Us</a></li>

                            </ul>
                        </li>
                    </ul>
                    <ul class="responsive-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li class="sub-items"><a href="#">Features</a>
                            <ul>
                                <li><a href="index.php#about-wrap">About Us</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li><a target="_blank" ;
                                        href="https://api.whatsapp.com/send?phone=0447827292641&text=Booking">Booking
                                        Now</a></li>
                                <li><a href="index.php#map">Find Us</a></li>

                            </ul>
                        </li>
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                    <a href="#" id="pull"></a>
                </nav>
            </div>
            <figure>
                @if (isset($data->logo[0]))
                <img src="{{$data->logo[0]->url}}" alt="Mozzarella-logo">
                @endif
                <figcaption>Escape</figcaption>
            </figure>
            <ul class="main-slider">
                @if (isset($data->slider))
                @foreach($data->slider as $slider)
                <li class="first">
                    <img src="{{$slider->url}}" alt="stars-moustache">
                    <a href="https://api.whatsapp.com/send?phone=0447827292641&text=Booking" target="_blank"
                        class="square-button">Book Now For</a>
                </li>
                @endforeach
                @endif
            </ul>
            <div class="pager-container">
                @if (isset($data->slider))
                @foreach($data->slider as $key => $slider)
                <a href="" data-slide-index="{{$key}}"></a>
                @endforeach
                @endif
            </div>
        </header>
        <!--/HEADER-->