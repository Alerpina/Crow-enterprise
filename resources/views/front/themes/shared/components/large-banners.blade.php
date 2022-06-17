@if($ps->large_banner == 1)
<!-- Banner Area One Start -->
<section class="banner-section">
    <div class="container">
        <div class="row">
            @foreach($large_banners->chunk(1) as $chunk)
            @foreach($chunk as $img)
            @if(env('THEME') == "theme-01" || env('THEME') == "theme-02")
            <div class="col-12 p-2">
                @else
                <div class="col-lg-12">
                    @endif
                    <div class="img">
                        @if(env('THEME') == "theme-01" || env('THEME') == "theme-02")
                        <a class=" banner-effect link-banner-larges" href="{{ $img->link }}">
                            <figure>
                                <img class="banner-larges" src="{{asset('storage/images/banners/'.$img->photo)}}"
                                    alt="">
                            </figure>
                        </a>
                        @else
                        <a class="{{ env('THEME') == " theme-08" ? "" : "banner-effect" }} banner-w100"
                            href="{{ $img->link }}">
                            <figure>
                                <img src="{{asset('storage/images/banners/'.$img->photo)}}" alt="Banner">
                            </figure>
                        </a>
                        @endif
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
