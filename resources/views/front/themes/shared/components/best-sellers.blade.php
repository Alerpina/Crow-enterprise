
@if($ps->best == 1)
<!-- Phone and Accessories Area Start -->
<section class="phone-and-accessories categori-item">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ __("Best Seller") }}
                        @if(env('THEME') == "theme-03" || env('THEME') == "theme-05" || env('THEME') == "theme-06" || env('THEME') == "theme-07")
                        <div id="post-title"> 
                            <img src="{{ asset('project/resources/views/front/themes/theme-03/assets/images/post-it.png')}}" class="img-fluid" alt="Post it">
                        </div>
                        @endif
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if($ps->best_seller_banner or $ps->best_seller_banner1)
            <div class="col-lg-10">
                @else
                <div class="col-lg-12" >
                    @endif
                    <div class="row row-theme">
                        @foreach($best_products as $prod)
                            @if(env('THEME') == "theme-01" || env('THEME') == "theme-02")
                                @include('includes.product.home-product')
                            @else
                                @include('front.themes.'.env('THEME', 'theme-01').'.components.home-product')
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 remove-padding d-none d-lg-block">
                    <div class="aside">
                        @if($ps->best_seller_banner)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->best_seller_banner_link }}">
                            <img src="{{asset('assets/images/'.$ps->best_seller_banner)}}" alt="" style="width:100%;border-radius: 5px;">
                        </a>
                        @endif
                        @if($ps->best_seller_banner1)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->best_seller_banner_link1 }}">
                            <img src="{{asset('assets/images/'.$ps->best_seller_banner1)}}" alt="" style="width:100%;border-radius: 5px;">
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Phone and Accessories Area start-->
@endif