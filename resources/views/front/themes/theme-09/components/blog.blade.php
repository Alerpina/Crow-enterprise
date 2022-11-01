@if ($ps->blog_posts === 1)
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
                        @foreach ($extra_blogs->chunk(2) as $posts)
                            @foreach ($posts as $blogg)
                                <div class="col">
                                    <div class="blog-box">
                                        <div class="blog-images">
                                            <div class="img" style="background-image:url('{{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }}');">
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
                                                    {{ mb_strlen($blogg->title, 'utf-8') > 80 ? mb_substr($blogg->title, 0, 80, 'utf-8') . '...' : $blogg->title }}
                                                </h4>
                                            </a>
                                            <p class="blog-text">
                                                {{ substr(strip_tags($blogg->details), 0, 130) }}...
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
</section>
@endif
