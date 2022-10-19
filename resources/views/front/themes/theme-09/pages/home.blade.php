@extends('front.themes.theme-09.layout')

@section('content')


@include('front.themes.theme-09.components.modal-order-tracking')
@include('front.themes.theme-09.components.header-slider')
@include('front.themes.theme-09.components.large-banners')
@include('front.themes.theme-09.components.best-sellers') 
@include('front.themes.theme-09.components.featured-products')
@include('front.themes.theme-09.components.small-banners-1')
@include('front.themes.theme-09.components.top-rated')
@include('front.themes.theme-09.components.flash-deals')
@include('front.themes.theme-09.components.services')
@include('front.themes.theme-09.components.hot-sales')
@include('front.themes.theme-09.components.small-banners-2')
@include('front.themes.theme-09.components.logo-slider')
@include('front.themes.theme-09.components.big-save')

<div class="container">
    <div class="row">
        @if ($ps->reviews_store === 1)
        <div class="col-md-{{$ps->blog_posts === 1 ? '6' : '12'}}">
            @include('front.themes.theme-09.components.reviews')
        </div>
        @endif
        @if ($ps->blog_posts === 1)
        <div class="col-md-{{$ps->reviews_store === 1 ? '6' : '12'}} ">
            @include('front.themes.theme-09.components.blog')
        </div>
        @endif
    </div>
</div>

@include('front.themes.theme-09.components.form')
@endsection
