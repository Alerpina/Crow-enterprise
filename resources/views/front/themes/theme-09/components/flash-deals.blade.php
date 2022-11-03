@if($ps->flash_deal == 1)
<!-- Electronics Area Start -->
<section class="oferta-relampago categori-item electronics-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title title-oferta">
                    VAPES E PODS
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($ps->flash_deal_banner or $ps->flash_deal_banner1)
            <div class="col-lg-10 row-theme">
                @else
                <div class="col-lg-12">
                    @endif
                    <div class="row">
                        @foreach($discount_products as $prod)

                        @include('front.themes.theme-09.components.flash-product')

                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 remove-padding d-none d-lg-block">
                    <div class="aside">
                        @if ($ps->flash_deal_banner)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->flash_deal_banner_link }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->flash_deal_banner) }}" alt=""
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                        @endif
                        @if ($ps->flash_deal_banner1)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->flash_deal_banner_link1 }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->flash_deal_banner1) }}" alt=""
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