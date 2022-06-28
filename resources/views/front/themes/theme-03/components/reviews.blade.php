@if($ps->reviews_store == 1)
<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ __("Testimony") }}
                        <div id="post-title">
                            <img src="{{ asset('assets/front/themes/theme-03/assets/images/post-it.png')}}"
                                class="img-fluid" alt="Post it">
                        </div>
                    </h2>
                </div>

                <div class="aside">
                    <div class="slider-wrapper">
                        <div class="aside-review-slider">
                            @foreach($reviews as $review)
                            <div class="slide-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-fluid"
                                            src="{{ $review->photo ? asset('storage/images/reviews/'.$review->photo) : asset('assets/images/noimage.png') }}"
                                            alt="">
                                    </div>
                                    <div class="col-md-8 coments">
                                        <h3 class="name">{{ $review->title }}</h3>
                                        <h6 class="dagenation">{{ $review->subtitle }}</h6>
                                        <div>
                                            {!! $review->details !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
