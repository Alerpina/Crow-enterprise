@if ($ps->reviews_store == 1)
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top">
                        <h2 class="section-title">
                        <i class="icofont-halloween-pumpkin"></i>{{ __('Testimony') }}
                        </h2>
                    </div>
                    <div class="aside bg-section-items">
                        <div class="slider-wrapper">
                            <div class="aside-review-slider">
                                @foreach ($reviews as $review)
                                    <div class="slide-item">
                                        <div class="top-area">
                                            <div class="right">
                                                <div class="content">
                                                    <h4 class="blog-title">{{ $review->title }}</h4>
                                                    <p class="dagenation">{{ $review->subtitle }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <blockquote class="review-text">
                                            <p>
                                                {!! $review->details !!}
                                            </p>
                                        </blockquote>
                                        <div class="left">
                                            <img src="{{ $review->photo ? asset('storage/images/reviews/' . $review->photo) : asset('assets/images/noimage.png') }}"
                                                alt="" loading="lazy">
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
