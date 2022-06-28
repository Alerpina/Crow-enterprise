@extends('front.themes.theme-01.layout')

@section('content')

@include('front.themes.theme-01.components.header-slider')
@include('front.themes.shared.components.featured-categories')
@include('front.themes.shared.components.featured-products')
@include('front.themes.shared.components.small-banners-1')
@include('front.themes.shared.components.best-sellers')
@include('front.themes.shared.components.flash-deals')
@include('front.themes.theme-01.components.large-banners')
@include('front.themes.theme-01.components.top-rated')
@include('front.themes.theme-01.components.small-banners-2')
@include('front.themes.shared.components.big-save')
@include('front.themes.shared.components.hot-sales')
<div class="container">
    <div class="row">
        @if ($ps->reviews_store === 1)
        <div class="col-md-{{$ps->blog_posts === 1 ? '6' : '12'}}">
            @include('front.themes.theme-01.components.reviews')
        </div>
        @endif
        @if ($ps->blog_posts === 1)
        <div class="col-md-{{$ps->reviews_store === 1 ? '6' : '12'}}">
            @include('front.themes.theme-01.components.blog')
        </div>
        @endif
    </div>
</div>
@include('front.themes.shared.components.logo-slider')

@endsection
