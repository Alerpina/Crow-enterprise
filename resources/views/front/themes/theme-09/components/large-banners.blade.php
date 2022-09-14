@if ($ps->large_banner == 1)
    <!-- Banner Area One Start -->
    <section class="banner-section">
        <div class="container">
            <div class="row">
                @foreach ($large_banners->chunk(1) as $chunk)
                    @foreach ($chunk as $img)
                        <div class="col-lg-12">
                            <div class="img">
                                <a class="banner-effect banner-w100" href="{{ $img->link }}">
                                    <figure>
                                        <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt="Banner"
                                            loading="lazy">
                                    </figure>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @break
            @endforeach
        </div>
    </div>
</section>
<!-- Banner Area One Start -->
@endif
