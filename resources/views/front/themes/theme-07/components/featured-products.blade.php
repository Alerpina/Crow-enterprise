@if($ps->featured == 1)
<!-- Trending Item Area Start -->
<section class="trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ __("Featured") }}
                        <div id="post-title">
                            <img src="{{ asset('assets/front/themes/theme-07/assets/images/post-it.png')}}"
                                class="img-fluid" alt="Post it">
                        </div>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="trending-item-slider">
                    @foreach($feature_products as $prod)

                    @include('front.themes.theme-07.components.slider-product')
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Tranding Item Area End -->
@endif
