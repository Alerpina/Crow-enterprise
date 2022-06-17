@if($ps->top_rated == 1)
<!-- Electronics Area Start -->
<section class="categori-item electronics-section best-seller">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ __("Top Rated") }}
                        @if(env('THEME') == "theme-03" || env('THEME') == "theme-05" || env('THEME') == "theme-06" ||
                        env('THEME') == "theme-07")
                        <div id="post-title">
                            <img src="{{ asset('project/resources/views/front/themes/theme-03/storage/images/post-it.png')}}"
                                class="img-fluid" alt="Post it">
                        </div>
                        @endif
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 row-theme">
                <div class="row">
                    @foreach($top_products as $prod)
                    @if(env('THEME','theme-01') == "theme-01" || env('THEME') == "theme-02")
                    @include('includes.product.top-product')
                    @else
                    @include('front.themes.'.env('THEME', 'theme-01').'.components.home-product')
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Electronics Area start-->
@endif
