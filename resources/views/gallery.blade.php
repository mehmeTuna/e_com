@component('label.header', [
'title' => 'Anasayfa',
'data' => $data
])


@endcomponent



<!--GALLERY-->
<div id="gallery-wrap">
    <section id="gallery">
        <img src="/public/images/title-detail.png" alt="title-detail">
        <h2>Relive Our Shows</h2>
        <p>GALLERY
            We offer great service, & always aim to please our customers. Open 7 days a week till late.</p>
        <hr>
        <ul id="gallery-3c" class="gallery">
            <!--GALLERY ITEM-->
            @if(count($data->gallery) > 0)
            @foreach($data->gallery as $value)
            <li>
                <a href="#">
                    <img src="{{$value->url}}" alt="cover">
                    <div>
                        <h5>Escape</h5>
                        <p class="date">Bar & Grill</p>
                        <p></p>
                    </div>
                </a>
            </li>
            @endforeach
            @endif
            <!--GALLERY ITEM-->

        </ul>

    </section>
</div>
<!--/GALLERY-->


@component('label.footer', [
'data' => $data
])

@endcomponent