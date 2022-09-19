@if ($ps->reviews_store == 1)
    <section class="blog-area">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="section-top">
                        <h2 class="section-title">
                            {{ __('Testimony') }}
                        </h2>
                    </div>
                    <div class="aside bg-section-items">
                        <div class="slider-wrapper">
                            <div class="aside-review-slider">
                                @foreach ($reviews as $review)
                                    <div class="slide-item">
                                        <div class="top-area">
                                            <div class="content">
                                                <img src="{{ $review->photo ? asset('storage/images/reviews/' . $review->photo) : asset('assets/images/noimage.png') }}"
                                                    alt="">
                                                <h4 class="name">{{ $review->title }}</h4>
                                                <p class="dagenation">{{ $review->subtitle }}</p>
                                                <blockquote class="review-text">
                                                    <p>
                                                        {!! $review->details !!}
                                                    </p>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-top">
                        <h2 class="section-title">
                            {{ __('Recent On Our Blog') }}
                        </h2>
                    </div>

                    <div class="bg-section-items">
                        @foreach ($extra_blogs->chunk(2) as $posts)
                            @foreach ($posts as $blogg)
                                <div class="row blog-box">
                                    <div class="col-lg-5">
                                        <img src="{{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="col-lg-7 pl-md-0">
                                        <a href='{{ route('front.blogshow', $blogg->id) }}'>
                                            <h4 class="blog-title">
                                                {{ mb_strlen($blogg->title, 'utf-8') > 40 ? mb_substr($blogg->title, 0, 40, 'utf-8') . '...' : $blogg->title }}
                                            </h4>
                                        </a>
                                        <p class="date-blog">
                                            {{ date('d', strtotime($blogg->created_at)) }}/{{ date('m', strtotime($blogg->created_at)) }}/{{ date('Y', strtotime($blogg->created_at)) }}
                                        </p>

                                        <div class="details">
                                            <p class="blog-text">
                                                {{ substr(strip_tags($blogg->details), 0, 170) }}
                                            </p>
                                            <a class="read-more-btn"
                                                href="{{ route('front.blogshow', $blogg->id) }}">{{ __('Read More') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @break
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endif
