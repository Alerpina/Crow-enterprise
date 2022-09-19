@if ($ps->bottom_small == 1)
    <!-- Banner Area One Start -->

    <section class="banner-section position-top">
        <div class="container">
            @foreach ($bottom_small_banners->chunk(3) as $chunk)
                <div class="row justify-content-center">
                    @foreach ($chunk as $img)
                        @if ($loop->first)
                            <div class="col-12 col-lg-4" style="background-color:#red;">
                                <div class="left">
                                    <a class="banner-effect shadow-banner" href="{{ $img->link }}" target="_blank">
                                        <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="col-6 col-lg-4">
                                <div class="left">
                                    <a class="banner-effect shadow-banner" href="{{ $img->link }}" target="_blank">
                                        <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @break
        @endforeach
    </div>
</section>
<!-- Banner Area One Start -->
@endif
