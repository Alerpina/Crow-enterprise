@if($ps->flash_deal == 1)
<!-- Electronics Area Start -->
<section class="oferta-relampago categori-item electronics-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title title-oferta">
                        {{ __("Flash Deal") }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 row-theme">
                <div class="flash-deals">
                    <div class="flas-deal-slider">
                        @foreach($discount_products as $prod)
                            @if(env('THEME') == "theme-01" || env('THEME') == "theme-02")
                                @include('includes.product.flash-product')
                            @else
                                @include('front.themes.'.env('THEME', 'theme-01').'.components.flash-product')
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Electronics Area start-->
@endif