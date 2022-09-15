@if ($ps->blog_posts == 1)
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-top">
                        <h2 class="section-title">
                            {{ __('Recent On Our Blog') }}
                            <div id="post-title">
                                <img src="{{ asset('assets/front/themes/theme-05/assets/images/post-it.png') }}"
                                    class="img-fluid" alt="Post it">
                            </div>
                        </h2>
                    </div>

                    <div class="row">
                        @foreach ($extra_blogs->chunk(5) as $posts)
                            @foreach ($posts as $blogg)
                                <div class="col-md-6 col-lg-3">
                                    <div class="blog-box">
                                        <div class="blog-images">
                                            <div class="img">
                                                <img src="{{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }}"
                                                    class="img-fluid" alt="">
                                                <div class="date d-flex justify-content-center">
                                                    <div class="box align-self-center">
                                                        <p>{{ date('d', strtotime($blogg->created_at)) }}</p>
                                                        <p>{{ date('M', strtotime($blogg->created_at)) }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="details">
                                            <a href="{{ route('front.blogshow', $blogg->id) }}">
                                                <h4 class="blog-title">
                                                    {{ mb_strlen($blogg->title, 'utf-8') > 40 ? mb_substr($blogg->title, 0, 40, 'utf-8') . '...' : $blogg->title }}
                                                </h4>
                                            </a>
                                            <p class="blog-text">
                                                {{ substr(strip_tags($blogg->details), 0, 170) }}
                                            </p>
                                            <a class="read-more-btn"
                                                href="{{ route('front.blogshow', $blogg->id) }}">{{ __("Read
                                                                                    More") }}</a>
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
