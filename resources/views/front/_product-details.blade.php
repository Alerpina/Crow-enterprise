<!-- Product Details Area Start -->
<section class="product-details-page">
    <div class="container">
        @include('front._product-details-validation')
        <div class="row">
            <div class="col-lg-10">
                <div class="row">
                    @include('front._product-details-photos')
                    {{-- @include('front._product-details-content') --}}
                </div>

                @if(config("features.marketplace"))
                @include('front._product-details-feature-marketplace')
                @endif

                @include('front._product-details-description')
            </div>
            <div class="col-lg-2">
                @include('front._product-details-sidebar')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
    </div>

    @if(!config("features.marketplace"))
    @include('front._product-details-trending')
    @endif

</section>
