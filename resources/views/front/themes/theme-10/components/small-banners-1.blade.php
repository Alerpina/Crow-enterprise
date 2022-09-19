@if ($ps->small_banner == 1)

    <!-- Banner Area One Start -->

    @foreach ($top_small_banners->chunk(2) as $chunk)
        <div class="row justify-content-center">
            @foreach ($chunk as $img)
                <div class="col-auto">
                    <div class="left">
                        <a href="{{ $img->link }}" target="_blank">
                            <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt="">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @break
@endforeach

<!-- Banner Area One Start -->
@endif
