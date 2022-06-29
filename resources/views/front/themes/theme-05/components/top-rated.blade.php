@if($ps->top_rated == 1)
<!-- Electronics Area Start -->
<section class="categori-item electronics-section best-seller">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ __("Top Rated") }}

                        <div id="post-title">
                            <img src="{{ asset('assets/front/themes/theme-05/assets/images/post-it.png')}}"
                                class="img-fluid" alt="Post it">
                        </div>

                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 row-theme">
                <div class="row">
                    @foreach($top_products as $prod)
                    @include('front.themes.theme-05.components.home-product')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Electronics Area start-->
@endif
