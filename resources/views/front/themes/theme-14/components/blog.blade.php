@if (count($extra_blogs) >= 1)
    <section class="blog-area">
        <div class="container">
            <div class="section-reviews">
                <h2 class="section-title">
                    {{ __('Recent On Our Blog') }}
                </h2>
            </div>

            <div class="carousel-blogs-items new-style-carousel owl-carousel owl-theme owl-loaded">
                @foreach ($extra_blogs->chunk(2) as $posts)
                    @foreach ($posts as $blogg)
                        <a href='{{ route('front.blogshow', $blogg->id) }}' class="item-blog">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="box-img-blog" style="background-image:url({{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }});"></div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                    <p class="date-blog">
                                    <img class="calendaryIcone" src="{{ asset('assets/front/themes/theme-14/assets/images/calendary.png') }}"
                                    class="img-fluid" alt="Post it">
                                    {{ date('d', strtotime($blogg->created_at)) }} de {{ strftime('%B', strtotime($blogg->created_at)) }} {{ date('Y', strtotime($blogg->created_at)) }}
                                        </p>
                                        <h4 class="blog-title">
                                            {{ mb_strlen($blogg->title, 'utf-8') > 40 ? mb_substr($blogg->title, 0, 40, 'utf-8') . '...' : $blogg->title }}
                                        </h4>
                                        <!-- <div class="details mb-3 ">
                                            {!! substr(strip_tags($blogg->details), 0, 170) !!}
                                        </div> -->
                                        <h4 class="lermaisBlog">Confira no nosso blog</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    
                @endforeach
            </div>
        </div>
    </section>
@endif
