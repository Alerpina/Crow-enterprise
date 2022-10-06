@if ($ps->service == 1)

    {{-- Info Area Start --}}
    <section class="info-area">
        <div class="container">

            @foreach ($services->chunk(4) as $chunk)
                <div class="row">

                    <div class="col-lg-12 p-0">
                        <div class="info-big-box">
                            <div id="services-carousel">
                                @foreach ($chunk as $service)
                                    <div class="item-slide">
                                        <div class="info-box">
                                            <a target="_blank" href="{{ $service->link }}">
                                                <div class="icon">
                                                    <img class="img-fluid-service"
                                                        src="{{ asset('storage/images/services/' . $service->photo) }}"
                                                        loading="lazy">
                                                    <h4 class="title">{{ $service->title }}</h4>
                                                </div>
                                                <div class="info">
                                                    <div class="details">
                                                        <p class="text">
                                                            {!! $service->details !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            @break
        @endforeach

    </div>
</section>
{{-- Info Area End --}}

@endif
