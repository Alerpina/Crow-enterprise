@if (count($extra_blogs) >= 1)
    <section class="blog-area">
        <div class="container">
            <div class="section-top">
                <h2 class="section-title">
                    {{ __('Recent On Our Blog') }}
                </h2>
            </div>

            <div class="carousel-blogs-items new-style-carousel owl-carousel owl-theme owl-loaded">
                @foreach ($extra_blogs->chunk(2) as $posts)
                    @foreach ($posts as $blogg)
                        <a href='{{ route('front.blogshow', $blogg->id) }}' class="item-blog">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <h4 class="blog-title">
                                            {{ mb_strlen($blogg->title, 'utf-8') > 40 ? mb_substr($blogg->title, 0, 40, 'utf-8') . '...' : $blogg->title }}
                                        </h4>
                                        <div class="details mb-3">
                                            {!! substr(strip_tags($blogg->details), 0, 170) !!}
                                        </div>
                                        <h4><small>Clique para ler mais <i class="fas fa-caret-right"></i></small></h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="box-img-blog" style="background-image:url({{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }});"></div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    
                @endforeach
            </div>
        </div>
    </section>
@endif
