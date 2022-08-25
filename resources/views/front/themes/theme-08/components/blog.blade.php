@if ($ps->blog_posts == 1)
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top">
                        <h2 class="section-title">
                            {{ __('Recent On Our Blog') }}
                        </h2>
                    </div>

                    <div class="bg-section-items">
                        <div class="row">
                            @foreach ($extra_blogs->chunk(3) as $posts)
                                @foreach ($posts as $blogg)
                                    <div class="col-md-4">
                                        <div class="blog-box">
                                            <img src="{{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }}"
                                                class="img-fluid" alt="">
                                            <a href="{{ route('front.blogshow', $blogg->id) }}">
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
    </div>
</section>
@endif
