@if($ps->partners == 1)
<!-- Partners Area Start -->
<section class="partners">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-top">
                    <h2 class="section-title">
                        {{ __("Brands") }}
                        @if(env('THEME') == "theme-03" || env('THEME') == "theme-05" || env('THEME') == "theme-06" ||
                        env('THEME') == "theme-07")
                        <div id="post-title">
                            <img src="{{ asset('project/resources/views/front/themes/theme-03/storage/images/post-it.png')}}"
                                class="img-fluid" alt="Post it">
                        </div>
                        @endif
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 row-theme">
                <div class="partner-slider">
                    @foreach($partners as $data)
                    <div class="item-slide">
                        <a href="{{ $data->link }}" target="_blank">
                            <img src="{{asset('storage/images/partner/'.$data->photo)}}" alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Partners Area Start -->
@endif
