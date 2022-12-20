@if($ps->featured == 1)
<!-- Trending Item Area Start -->
<section class="featured-products py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box-title-featured text-center">
                     <h4 style="font-weight:500;letter-spacing:-1px;font-size:1.4em;">Visite nossa categoria</h4>
                     <h2 style="word-break:break-all;font-size:2.5em;">{{ __("Featured") }}</h2>
                     <p style="font-size: 1em;">Fique por dentro dos lançamentos e novidades da loja!</p>
                </div>
            </div>
            <div class="col-lg-9 remove-padding">
                <div class="trending-item-slider new-style-carousel owl-carousel owl-theme owl-loaded">
                    @foreach($feature_products as $prod)
                    @include('front.themes.'.env('THEME', 'theme-01').'.components.slider-product')
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Tranding Item Area End -->
@endif
