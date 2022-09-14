@if ($ps->bottom_small == 1)
    <!-- Banner Area One Start -->

    <section>
        <div class="container">
            @foreach ($bottom_small_banners->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $img)
                        <div class="col-10 col-lg-4">
                            <div class="left">

                                <a class="banner-effect shadow-banner" href="{{ $img->link }}" target="_blank">
                                    <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt=""
                                        loading="lazy">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @break
        @endforeach
    </div>
</section>
<!-- Banner Area One Start -->
@endif
