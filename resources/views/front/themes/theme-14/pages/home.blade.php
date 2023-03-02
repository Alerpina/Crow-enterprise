@extends('front.themes.theme-14.layout')

@section('content')
    @include('front.themes.theme-14.components.header-slider')
    @include('front.themes.theme-14.components.small-banners-2')
    @include('front.themes.theme-14.components.featured-categories')
    @include('front.themes.shared.components.featured-products')
    @include('front.themes.theme-14.components.logo-slider')
    @include('front.themes.theme-14.components.large-banners')
    @include('front.themes.theme-14.components.best-sellers')
    @include('front.themes.shared.components.flash-deals')
    @include('front.themes.theme-14.components.small-banners-1')
    @include('front.themes.shared.components.top-rated')
    @include('front.themes.shared.components.big-save')
    @include('front.themes.shared.components.hot-sales')
    @include('front.themes.theme-14.components.services')
    @include('front.themes.theme-14.components.reviews')
    @include('front.themes.theme-14.components.blog')
@endsection
@section('styles')
    @parent
    <style>
        @media (min-width: 768px) {
            .menufixed {
                background-color: <?php echo $gs->header_color; ?>2b;
            }

            /* .menufixed {
                -webkit-backdrop-filter: blur(10px);
                backdrop-filter: blur(10px);
            } */

            .menufixed {
                position: relative;
                z-index: 99;
                top: 0px !important;
                width: 100%;
            }
        }
    </style>
@endsection
