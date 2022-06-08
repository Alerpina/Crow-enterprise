<!-- Trending Item Area Start -->
<div class="trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ __("Related Products") }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="trending-item-slider">
                    @foreach($related_products as $prod)
                    @include('includes.product.slider-product')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tranding Item Area End -->
