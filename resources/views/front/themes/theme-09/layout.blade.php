@extends('front.themes.shared.layout')

@section('styles')

    
<!--FONT-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

@if (env('VARIANT_THEME'))
    <link rel="stylesheet" href="{{ asset('assets/front/themes/shared/assets/css/'. env('VARIANT_THEME')) .'.css' }}">
@endif

@endsection