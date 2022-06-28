@if($ps->large_banner == 1)
<!-- Banner Area One Start -->
<section class="banner-section">
    <div class="container">
        <div class="row">
            @foreach($large_banners->chunk(1) as $chunk)
            @foreach($chunk as $img)

            <div class="col-12 p-2">

                <div class="img">

                    <a class=" banner-effect link-banner-larges" href="{{ $img->link }}">
                        <figure>
                            <img class="banner-larges" src="{{asset('storage/images/banners/'.$img->photo)}}" alt="">
                        </figure>
                    </a>
                </div>
            </div>
            @endforeach
            @break
            @endforeach
        </div>
    </div>
</section>
<!-- Banner Area One Start -->
@endif
