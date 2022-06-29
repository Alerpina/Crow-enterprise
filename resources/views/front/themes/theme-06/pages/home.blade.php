@extends('front.themes.theme-06.layout')

@section('content')

@include('front.themes.theme-06.components.header-slider')
@include('front.themes.theme-06.components.services')
@include('front.themes.shared.components.featured-categories')
@include('front.themes.theme-06.components.featured-products')
@include('front.themes.shared.components.large-banners')
@include('front.themes.theme-06.components.best-sellers')
@include('front.themes.theme-06.components.logo-slider')
@include('front.themes.shared.components.flash-deals')
@include('front.themes.shared.components.small-banners-2')
@include('front.themes.theme-06.components.top-rated')
@include('front.themes.shared.components.small-banners-1')
@include('front.themes.theme-06.components.big-save')
@include('front.themes.theme-06.components.hot-sales')
<div class="container">
    <div class="row">
        @if ($ps->reviews_store === 1)
        <div class="col-md-{{$ps->blog_posts === 1 ? '6' : '12'}}">
            @include('front.themes.theme-06.components.reviews')
        </div>
        @endif
        @if ($ps->blog_posts === 1)
        <div class="col-md-{{$ps->reviews_store === 1 ? '6' : '12'}}">
            @include('front.themes.theme-06.components.blog')
        </div>
        @endif
    </div>
</div>

@endsection
