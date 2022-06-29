@if($ps->hot_sale == 1)
<!-- hot-and-new-item Area Start -->
<section class="hot-and-new-item">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="accessories-slider">
                    <div class="slide-item">
                        <div class="row">
                            <div class="col-lg-12 col-sm-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                            {{ __("Hot") }}
                                            <div id="post-title">
                                                <img src="{{ asset('assets/front/themes/theme-07/assets/images/post-it.png')}}"
                                                    class="img-fluid" alt="Post it">
                                            </div>
                                        </h2>
                                    </div>
                                    <div class="hot-and-new-item-slider row-theme">
                                        @foreach($hot_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('includes.product.list-product')
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                            {{ __("New") }}
                                            <div id="post-title">
                                                <img src="{{ asset('assets/front/themes/theme-07/assets/images/post-it.png')}}"
                                                    class="img-fluid" alt="Post it">
                                            </div>
                                        </h2>
                                    </div>

                                    <div class="hot-and-new-item-slider row-theme">

                                        @foreach($latest_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('includes.product.list-product')
                                            </ul>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                            {{ __("Trending") }}
                                            <div id="post-title">
                                                <img src="{{ asset('assets/front/themes/theme-07/assets/images/post-it.png')}}"
                                                    class="img-fluid" alt="Post it">
                                            </div>
                                        </h2>
                                    </div>


                                    <div class="hot-and-new-item-slider row-theme">

                                        @foreach($trending_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('includes.product.list-product')
                                            </ul>
                                        </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                            {{ __("Sale") }}
                                            <div id="post-title">
                                                <img src="{{ asset('assets/front/themes/theme-07/assets/images/post-it.png')}}"
                                                    class="img-fluid" alt="Post it">
                                            </div>
                                        </h2>
                                    </div>

                                    <div class="hot-and-new-item-slider row-theme">

                                        @foreach($sale_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('includes.product.list-product')
                                            </ul>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Clothing and Apparel Area start-->
@endif
