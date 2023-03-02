@if ($ps->reviews_store == 1)
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-reviews">
                        <h2 class="section-title">
                            {{ __('Testimony') }}
                        </h2>
                    </div>
                    <div class="aside bg-section-items">
                        <div class="slider-wrapper">
                            <div class="aside-review-slider">
                                @foreach ($reviews as $review)
                                    <article class="slide-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img src="{{ $review->photo ? asset('storage/images/reviews/' . $review->photo) : asset('assets/images/noimage.png') }}"
                                                    class="img-fluid imageComentarios">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="p-3">
                                                    <div class="row justify-content-between">
                                                        <div class="col-8">
                                                            <h4 class="name m-0">{{ $review->title }}</h4>
                                                            <p class="dagenation text-muted font-weight-light">{{ $review->subtitle }}</p>
                                                        </div>
                                                        <!-- <div class="col-2">
                                                            <svg width="100%" height="auto" viewBox="0 0 142 142" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M114.884 39.5173C120.978 45.9901 124.25 53.2498 124.25 65.0181C124.25 85.7264 109.713 104.287 88.5725 113.464L83.2889 105.311C103.021 94.6369 106.879 80.786 108.417 72.053C105.24 73.6978 101.08 74.2718 97.0037 73.8931C86.3301 72.905 77.9166 64.1424 77.9166 53.2498C77.9166 47.7576 80.0983 42.4904 83.9819 38.6068C87.8655 34.7233 93.1327 32.5415 98.6249 32.5415C104.973 32.5415 111.044 35.4407 114.884 39.5173ZM55.7172 39.5173C61.8114 45.9901 65.0833 53.2498 65.0833 65.0181C65.0833 85.7264 50.5461 104.287 29.4058 113.464L24.1222 105.311C43.8543 94.6369 47.712 80.786 49.2503 72.053C46.0731 73.6978 41.9137 74.2718 37.8371 73.8931C27.1634 72.905 18.7558 64.1424 18.7558 53.2498C18.7558 47.7576 20.9376 42.4904 24.8212 38.6068C28.7047 34.7233 33.972 32.5415 39.4642 32.5415C45.8127 32.5415 51.8832 35.4407 55.7232 39.5173H55.7172Z" fill="currentColor"/>
                                                            </svg>                                                    
                                                        </div> -->
                                                    </div>
                                                    <div>
                                                        {!! $review->details !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
