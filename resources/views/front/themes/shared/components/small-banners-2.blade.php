@if($ps->bottom_small == 1)
<!-- Banner Area One Start -->
@if(env("THEME") == "theme-01")
<section class="banner-section">
@elseif(env("THEME") == "theme-07" || env("THEME") == "theme-08" )
<section class="small-banners-2">
@else 
<section>
@endif
    <div class="container">
        @foreach($bottom_small_banners->chunk(3) as $chunk)
        <div class="row {{ env("THEME") == "theme-08" ? "justify-content-center" : ""}}">
            @foreach($chunk as $img)
            <div class="col-10 col-lg-4 {{ env("THEME") == "theme-01" || env("THEME") == "theme-02" ? "remove-padding" : ""}}">
                <div class="left">
                    @if(env("THEME") == "theme-01" || env("THEME") == "theme-02")
                    <a class="banner-effect" href="{{ $img->link }}" target="_blank">
                    @else 
                    <a class="banner-effect shadow-banner" href="{{ $img->link }}" target="_blank">
                    @endif
                        <img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @break
        @endforeach
    </div>
</section>
<!-- Banner Area One Start -->
@endif