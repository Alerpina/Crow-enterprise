@if($ps->slider == 1)

@if(count($sliders))
@include('includes.slider-style')
@endif
@endif

@if($ps->slider == 1)
<!-- Hero Area Start -->
<section class="hero-area">
    @if($ps->slider == 1)

    @if(count($sliders))

    <div class="hero-area-slider">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="slide-progress"></div>
                    <div class="intro-carousel">
                        @foreach($sliders as $data)
                        <a href="{{$data->link}}" target="_blank">
                            <div class="intro-content">
                                <img src="{{asset('storage/images/sliders/'.$data->photo)}}">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="slider-content">
                                                <!-- layer 1 -->
                                                <div class="layer-1">
                                                    <h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}"
                                                        class="subtitle subtitle{{$data->id}}"
                                                        data-animation="animated {{$data->subtitle_anime}}">
                                                        {{$data->subtitle_text}}</h4>
                                                    <h2 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}"
                                                        class="title title{{$data->id}}"
                                                        data-animation="animated {{$data->title_anime}}">
                                                        {{$data->title_text}}</h2>
                                                </div>
                                                <!-- layer 2 -->
                                                <div class="layer-2">
                                                    <p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"
                                                        class="text text{{$data->id}}"
                                                        data-animation="animated {{$data->details_anime}}">
                                                        {{$data->details_text}}</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    @endif

</section>
<!-- Hero Area End -->
@endif
