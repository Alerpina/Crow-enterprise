@if ($ps->featured_category == 1)
    @php
        $categoryhasimage = false;
        foreach ($categories->where('is_featured', '=', 1) as $cat) {
            if (!empty($cat->image)) {
                $categoryhasimage = true;
                break;
            }
            $categoryhasimage = false;
        }
    @endphp
    {{-- Slider buttom Category Start --}}
    <section class="slider-buttom-category categorias-destaq">
        <div class="container">
            <div class="row">
                @if ($categoryhasimage)
                    <div class="col-12">
                        <h3 class="titulo-categorias">{{ __('Categories Highlight') }}</h2>
                    </div>
                @endif
                <div class="carousel-categorys-highlight new-style-carousel owl-carousel owl-theme owl-loaded">
                    @foreach ($categories->where('is_featured', '=', 1) as $cat)
                        <div class="card-cat">
                            <a href="{{ route('front.category', $cat->slug) }}">
                                <img class="img-fluid" src="{{ asset('storage/images/categories/' . $cat->image) }}"
                                    alt="">
                                <h6 class="text-center desc-categorias">{{ $cat->name }}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- Slider buttom banner End --}}

@endif
