@if($ps->featured == 1)
<!-- Phone and Accessories Area start -->
<section class="phone-and-accessories categori-item">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title">
                    CELULARES
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($ps->featured_banner or $ps->featured_banner1)
            <div class="col-lg-10 row-theme">
                @else
                <div class="col-lg-12">
                    @endif
                    <div class="row">
                    @foreach($feature_products as $prod)
                    @include('front.themes.theme-09.components.slider-product')
                    @endforeach
                    </div>
                </div>
                <div class="col-lg-2 remove-padding d-none d-lg-block">
                    <div class="aside">
                        @if ($ps->featured_banner)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->featured_banner_link }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->featured_banner) }}"
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                        @endif
                        @if ($ps->featured_banner1)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->featured_banner_link1 }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->featured_banner1) }}"
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Phone and Accessories Area start-->
@endif