		<!--FOOTER-->
		<footer>
		    <section id="info">
		        <!--ABOUT MOZZARELLA-->
		        <article>
		            <h5>About Escape</h5>
		            <p>{{$data->about}}</p>
		            <ul class="c-info">
		                <li>{{$data->address}}</li>
		                <li>{{$data->email}}</li>
		                <li><a href="tel://{{$data->phone}}">{{$data->phone}}</li>
		            </ul>
		        </article>
		        <!--/ABOUT MOZZARELLA-->

		        <!--OUR LATESTS POSTS-->
		        <article class="side-posts latests">
		            <h5>Our Latests Posts</h5>
		            <!--POST-->
		            <article>
		                <div class="circle small">
		                    <figure class="imgLiquidFill">
		                        <img src="/public/images/blog/blog_image.png" alt="post">
		                    </figure>
		                    <a href="post.html">
		                        <img src="/public/images/plus-icon-small.png" alt="plus-icon-small">
		                    </a>
		                </div>
		                <h6><a href="post.html">Touring Through The City</a></h6>
		                <p>Lorem ipsum dolor sit amet, conte ad ipsum lorem.</p>
		            </article>
		            <!--/POST-->

		            <!--POST-->
		            <article>
		                <div class="circle small">
		                    <figure class="imgLiquidFill">
		                        <img src="/public/images/blog/blog_image.png" alt="post">
		                    </figure>
		                    <a href="post.html">
		                        <img src="/public/images/plus-icon-small.png" alt="plus-icon-small">
		                    </a>
		                </div>
		                <h6><a href="post.html">10 Easy Red Onion Recipes</a></h6>
		                <p>Lorem ipsum dolor sit amet, conte ad ipsum lorem.</p>
		            </article>
		            <!--/POST-->

		            <!--POST-->
		            <article>
		                <div class="circle small">
		                    <figure class="imgLiquidFill">
		                        <img src="/public/images/blog/blog_image.png" alt="post">
		                    </figure>
		                    <a href="post.html">
		                        <img src="/public/images/plus-icon-small.png" alt="plus-icon-small">
		                    </a>
		                </div>
		                <h6><a href="post.html">Healthy Tea Benefits</a></h6>
		                <p>Lorem ipsum dolor sit amet, conte ad ipsum lorem.</p>
		            </article>
		            <!--/POST-->
		        </article>
		        <!--/OUR LATESTS POSTS-->

		        <!--FLICKR WIDGET-->
		        <article>
		            <h5>Flickr Widget</h5>
		            <ul id="flickr-w"></ul>
		        </article>
		        <!--/FLICKR WIDGET-->

		        <!--OPENING HOURS-->
		        <article>
		            <h5>Opening Hours</h5>
		            <article class="op-hours">
		                <div>
		                    <h6>Monday</h6>
		                    <h6>9:00PM - 24:00AM</h6>
		                </div>
		                <div>
		                    <h6>Tuesday</h6>
		                    <h6>9:00PM - 24:00AM</h6>
		                </div>
		                <div>
		                    <h6>Wednesday</h6>
		                    <h6>9:00PM - 24:00AM</h6>
		                </div>
		                <div>
		                    <h6>Thursday</h6>
		                    <h6>9:00PM - 24:00AM</h6>
		                </div>
		                <div>
		                    <h6>Friday</h6>
		                    <h6>9:00PM - 24:00AM</h6>
		                </div>
		                <div>
		                    <h6>Saturday</h6>
		                    <h6>9:00PM - 24:00AM</h6>
		                </div>
		                <div>
		                    <h6>Sunday</h6>
		                    <h6>9:00PM - 24:00AM</h6>
		                </div>
		            </article>
		        </article>
		        <!--/OPENING HOURS-->
		    </section>
		    <div id="copy-wrap">
		        <section id="copy">
		            <h5><span>Escape Bar & Grill 2019 |</span> All Rights Reserved</h5>
		            <nav>
		                <ul>
		                    <li><a href="index.php">Home</a></li>
		                    <li><a href="menu.php">Menu</a></li>
		                    <li><a href="https://api.whatsapp.com/send?phone=0447827292641&text=Booking" target="_blank"
		                            ;>Booking</a></li>
		                    <li><a href="galeri.php">Gallery</a></li>
		                    <li><a href="index.php#about-warp">About Us</a></li>
		                    <li><a href="index.php#contact">Contact</a></li>
		                </ul>
		            </nav>
		        </section>
		    </div>
		</footer>
		<!--/FOOTER-->
		</main>

		<!-- jQuery -->
		<script src="/public/js/jquery-1.11.1.min.js"></script>
		<!-- bxSlider -->
		<script src="/public/js/jquery.bxslider.min.js"></script>
		<!-- magnificPopup -->
		<script src="/public/js/jquery.magnific-popup.min.js"></script>
		<!-- Img Liquid -->
		<script src="/public/js/imgLiquid-min.js"></script>
		<!-- Tooltipster -->
		<script src="/public/js/jquery.tooltipster.min.js"></script>
		<!-- Main -->
		<script src="/public/js/main.js"></script>
		<!-- Validate -->
		<script src="/public/js/main-validate.js"></script>
		<!-- Contact -->
		<script src="/public/js/contact.js"></script>
		<!-- Subscribe -->
		<script src="/public/js/subscribe.js"></script>
		<!-- Google Maps API -->
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<!-- Google Maps Config -->
		<script src="/public/js/gmaps.js"></script>
		<script>
$(function() {
    /*-----------------
    	MAIN SLIDER
    -----------------*/
    $('.main-slider').bxSlider({
        pagerCustom: '.pager-container',
        controls: false,
        easing: 'ease-in',
        speed: 800,
        auto: true,
        pause: 6000
    });

    /*-------------
    	VIDEO
    -------------*/
    $('#video .radial-progress').on('click', function() {
        $('#video > iframe').show();
    });

    /*----------------
    	TOOLTIP
    ----------------*/
    $('.tooltip').tooltipster({
        animation: 'grow',
        position: 'bottom'
    });

    /*-----------------
    	RESIZE IMAGE
    -----------------*/
    $("figure.imgLiquidFill").imgLiquid();

    /*----------------
    	IMAGE POPUP
    ----------------*/
    $('ul.dishes > li > div > a').magnificPopup({
        type: 'image',
        removalDelay: 300,
        mainClass: 'mfp-fade',
        image: {
            tError: 'The image could not be loaded.'
        },
        closeMarkup: '<span class="mfp-close"></span>'
    });
});
		</script>
		</body>

		</html>