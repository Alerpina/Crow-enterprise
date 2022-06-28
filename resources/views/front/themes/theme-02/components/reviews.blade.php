@if ($ps->reviews_store === 1)
<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="aside">
                    <div class="slider-wrapper">
                        <div class="aside-review-slider">
                            @foreach($reviews as $review)
                            <div class="slide-item">
                                <div class="top-area">
                                    <div class="left">
                                        <img src="{{ $review->photo ? asset('storage/images/reviews/'.$review->photo) : asset('assets/images/noimage.png') }}"
                                            alt="">
                                    </div>
                                    <div class="right">
                                        <div class="content">
                                            <h4 class="name">{{ $review->title }}</h4>
                                            <p class="dagenation">{{ $review->subtitle }}</p>
                                        </div>
                                    </div>
                                </div>
                                <blockquote class="review-text">
                                    <p>
                                        {!! $review->details !!}
                                    </p>
                                </blockquote>
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
