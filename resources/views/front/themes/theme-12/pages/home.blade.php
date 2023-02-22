@extends('front.themes.theme-12.layout')

@section('content')
    @include('front.themes.theme-12.components.header-slider')
    @include('front.themes.theme-12.components.small-banners-2')
    @include('front.themes.shared.components.featured-products')
    @include('front.themes.shared.components.logo-slider')
    @include('front.themes.shared.components.large-banners')
    @include('front.themes.shared.components.flash-deals')

    @include('front.themes.theme-12.components.services')
    @include('front.themes.shared.components.featured-categories')

    @include('front.themes.shared.components.best-sellers')
    @include('front.themes.shared.components.top-rated')
    @include('front.themes.shared.components.small-banners-1')
    @include('front.themes.shared.components.big-save')
    @include('front.themes.shared.components.hot-sales')
    @include('front.themes.theme-12.components.reviews')
@endsection
@section('styles')
    @parent
    <style>
        @media (min-width: 768px) {
            .menufixed {
                background-color: <?php echo $gs->header_color; ?>2b;
            }

            .menufixed {
                -webkit-backdrop-filter: blur(10px);
                backdrop-filter: blur(10px);
            }

            .menufixed {
                position: absolute;
                z-index: 99;
                top: 30px !important;
                width: 100%;
            }
        }
    </style>
@endsection
