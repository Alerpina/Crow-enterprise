@if($ps->flash_deal == 1)
<!-- Electronics Area Start -->
<section class="oferta-relampago categori-item electronics-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box-title-featured text-center">
                     <h4 style="font-weight:500;letter-spacing:-1px;font-size:1.4em;">Visite nossa categoria</h4>
                     <h2 style="word-break:break-all;font-size:2.5em;">{{ __("Flash Deal") }}</h2>
                     <p style="font-size: 1em;">Fique por dentro dos lançamentos e novidades da loja!</p>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="flash-deals-theme-13">
                    <div class="flas-deal-slider new-style-carousel owl-carousel owl-theme owl-loaded">
                        @foreach($discount_products as $prod)
                            @include('front.themes.'.env('THEME', 'theme-01').'.components.flash-product')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Electronics Area start-->
@endif
