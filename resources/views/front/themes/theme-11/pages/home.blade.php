@extends('front.themes.theme-11.layout')

@section('content')
    @include('front.themes.theme-11.components.header-slider')
    @include('front.themes.theme-11.components.small-banners-2')
    @include('front.themes.shared.components.featured-products')
    @include('front.themes.shared.components.logo-slider')
    @include('front.themes.shared.components.large-banners')
    @include('front.themes.shared.components.flash-deals')

    @include('front.themes.theme-11.components.services')
    @include('front.themes.shared.components.featured-categories')

    @include('front.themes.shared.components.best-sellers')
    @include('front.themes.shared.components.top-rated')
    @include('front.themes.shared.components.small-banners-1')
    @include('front.themes.shared.components.big-save')
    @include('front.themes.shared.components.hot-sales')
    @include('front.themes.theme-11.components.reviews')
@endsection
