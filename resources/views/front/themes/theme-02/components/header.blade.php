<section class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="content">
                    <div class="left-content">
                        <div class="list">
                            <ul>
                                @if(config("features.lang_switcher") && $gs->is_language == 1)
                                <li>
                                    <div class="language-selector">
                                        <i class="fas fa-globe-americas"></i>
                                        <select name="language" class="language selectors nice">
                                            @foreach($locales as $language)
                                            <option value="{{route('front.language',$language->id)}}" {{$slocale->id ==
                                                $language->id ? 'selected' : ''}}>
                                                {{$language->language}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                @endif

                                @if(config("features.currency_switcher") && $gs->is_currency == 1)
                                <li>
                                    <div class="currency-selector">
                                        <span>{{ $scurrency->sign }}</span>
                                        <select name="currency" class="currency selectors nice">
                                            @foreach($currencies as $currency)
                                            <option value="{{route('front.currency',$currency->id)}}" {{ $scurrency->id
                                                == $currency->id ? 'selected' : ''}}>
                                                {{$currency->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                @endif

                                @if($gs->show_currency_values == 1)
                                @php
                                $top_first_curr = $curr;
                                $top_curr = $scurrency;
                                @endphp

                                @if($scurrency->id != 1)
                                <li>
                                    <div class="currency-selector">
                                        <span><i class="fas fa-coins"></i>
                                            {{ __("Currency Rate") }}:
                                            {{
                                            $top_first_curr->sign.number_format($top_first_curr->value,$top_first_curr->decimal_digits,$top_first_curr->decimal_separator,$top_first_curr->thousands_separator)
                                            }}
                                            =
                                            {{ $top_curr->sign . ' ' .number_format($top_curr->value
                                            ,$top_curr->decimal_digits,$top_curr->decimal_separator,$top_curr->thousands_separator)
                                            }}
                                        </span>
                                    </div>
                                </li>
                                @endif
                                @endif

                                @if(Auth::guard('admin')->check())
                                <li>
                                    <div class="mybadge1">
                                        <a href="{{ route('admin.logout') }}">
                                            {{ __('Viewing as Admin')}}
                                            <i class="fas fa-power-off"></i>
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="list">
                            <ul>
                                @if(!Auth::guard('web')->check())
                                <li class="login">
                                    <a href="{{ route('user.login') }}" class="sign-log">
                                        <div class="links">
                                            <span class="sign-in">{{ __("Sign in") }}</span> <span>|</span>
                                            <span class="join">{{ __("Join") }}</span>
                                        </div>
                                    </a>
                                </li>
                                @else
                                <li class="profilearea my-dropdown">
                                    <a href="javascript: ;" id="profile-icon" class="profile carticon">
                                        <span class="text">
                                            <i class="far fa-user"></i> {{ __("My Account") }}
                                            <i class="fas fa-chevron-down"></i>
                                        </span>
                                    </a>
                                    <div class="my-dropdown-menu profile-dropdown">
                                        <ul class="profile-links">
                                            <li>
                                                <a href="{{ route('user-dashboard') }}">
                                                    <i class="fas fa-angle-double-right"></i>
                                                    {{ __("User Panel") }}
                                                </a>
                                            </li>

                                            @if(config("features.marketplace"))
                                            @if(Auth::user()->IsVendor())
                                            <li>
                                                <a href="{{ route('vendor-dashboard') }}">
                                                    <i class="fas fa-angle-double-right"></i>
                                                    {{ __("Vendor Panel") }}
                                                </a>
                                            </li>
                                            @endif
                                            @endif

                                            <li>
                                                <a href="{{ route('user-profile') }}">
                                                    <i class="fas fa-angle-double-right"></i>
                                                    {{ __("Edit Profile") }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user-logout') }}">
                                                    <i class="fas fa-angle-double-right"></i>
                                                    {{ __("Logout") }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif
                                @if(config("features.productsListPdf"))
                                <li class="login ml-0">
                                    <a target="_blank" href="{{ route('download-list-pdf') }}">
                                        <div class="links">
                                            | {{ __("Products list - PDF") }}
                                            <i class="fas fa-download"></i>
                                        </div>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Header Area End -->

<!-- Logo Header Area Start -->
<div class="menufixed">
    <section class="logo-header">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3 col-sm-6 col-5 remove-padding">
                    <div class="logo">
                        <a href="{{ route('front.index') }}">
                            <img src="{{asset('storage/images/'.$gs->logo)}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-12 remove-padding order-last order-sm-2 order-md-2">
                    <div class="search-box-wrapper">
                        <div class="search-box">
                            <form id="searchForm" class="search-form" action="{{ route('front.category') }}"
                                method="GET">

                                @if (!empty(request()->input('sort')))
                                <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                                @endif

                                @if (!empty(request()->input('minprice')))
                                <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                                @endif

                                @if (!empty(request()->input('maxprice')))
                                <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                                @endif

                                <input type="text" id="prod_name" name="searchHttp"
                                    placeholder="{{ __('Search For Product') }}"
                                    value="{{ request()->input('searchHttp') }}" autocomplete="off">
                                <div class="autocomplete">
                                    <div id="myInputautocomplete-list" class="autocomplete-items"></div>
                                </div>
                                <button type="submit"><i class="icofont-search-1"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-7 remove-padding order-lg-last">
                    <div class="helpful-links">
                        <ul class="helpful-links-inner">

                            @if($gs->is_cart)
                            <li class="my-dropdown">
                                <a href="javascript:;" class="cart carticon">
                                    <div class="icon">
                                        <i class="cart-sacola"></i>
                                        <span class="cart-quantity" id="cart-count">
                                            {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
                                        </span>
                                    </div>
                                </a>
                                <div class="my-dropdown-menu" id="cart-items">
                                    @include('load.cart')
                                </div>
                            </li>
                            @endif

                            <li class="wishlist" data-toggle="tooltip" data-placement="top" title="{{ __('Wish') }}">

                                @if(Auth::guard('web')->check())
                                <a href="{{ route('user-wishlists') }}" class="wish">
                                    <i class="far fa-heart"></i>
                                    <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                </a>
                                @else
                                <a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"
                                    class="wish">
                                    <i class="far fa-heart"></i>
                                    <span id="wishlist-count">0</span>
                                </a>
                                @endif

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Logo Header Area End -->

    <!--Main-Menu Area Start-->
    <div class="mainmenu-area mainmenu-bb">
        <div class="container">
            <div class="row align-items-center mainmenu-area-innner">
                <div class="col-lg-12 col-md-12 categorimenu-wrapper remove-padding">
                    <!--categorie menu start-->
                    <div class="categories_menu vertical">
                        <div class="categories_title">
                            <h2 class="categori_toggle"><i class="fa fa-bars"></i> {{ __("Categories") }}
                                <i class="fa fa-angle-down arrow-down"></i>
                            </h2>
                        </div>
                        <div class="categories_menu_inner">
                            <ul style="width:100%;">
                                @php
                                $i=1;
                                @endphp

                                @foreach($categories as $category)
                                @php
                                $count = count($category->subs_order_by);
                                @endphp
                                <li class="{{$count ? 'dropdown_list':''}}
                                        {{ $i >= 15 ? 'rx-child' : '' }} qntd">

                                    @if($count)
                                    @if($category->photo)
                                    <div class="img">
                                        <img src="{{ asset('storage/images/categories/'.$category->photo) }}" alt="">
                                    </div>
                                    @endif
                                    <div class="link-area">
                                        <span><a href="{{ route('front.category',$category->slug) }}">
                                                {{ $category->name }}</a>
                                        </span>

                                        @if($count)
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </div>
                                    @else
                                    <a href="{{ route('front.category',$category->slug) }}">
                                        @if($category->photo)
                                        <img src="{{ asset('storage/images/categories/'.$category->photo) }}">
                                        @endif
                                        {{ $category->name }}
                                    </a>
                                    @endif

                                    @if($count)
                                    @php
                                    $ck = 0;

                                    foreach($category->subs_order_by as $subcat):
                                    if(count($subcat->childs_order_by) > 0):
                                    $ck = 1;
                                    break;
                                    endif;
                                    endforeach;

                                    @endphp

                                    <ul
                                        class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">

                                        @foreach($category->subs_order_by as $subcat)
                                        <li>
                                            <a href="{{ route('front.subcat',
                                                            ['slug1' => $category->slug,
                                                            'slug2' => $subcat->slug]) }}">
                                                {{$subcat->name}}
                                            </a>

                                            @if(count($subcat->childs_order_by) > 0)
                                            <div class="categorie_sub_menu">
                                                <ul>
                                                    @foreach($subcat->childs_order_by as $childcat)
                                                    <li>
                                                        <a href="{{ route('front.childcat',
                                                                                ['slug1' => $category->slug,
                                                                                'slug2' => $subcat->slug,
                                                                                'slug3' => $childcat->slug]) }}">
                                                            {{$childcat->name}}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </li>
                                        @endforeach

                                    </ul>

                                    @endif

                                </li>

                                @php
                                $i++;
                                @endphp

                                @if($i == 15)
                                <li>
                                    <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i>
                                        {{ __("See All Categories") }}
                                    </a>
                                </li>
                                @break
                                @endif

                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="categories_menu horizontal">
                        <div class="categories_title_horizontal">
                            <h2 class="categori_toggle"><i class="fa fa-bars"></i> {{ __("Categories") }}
                                <i class="fa fa-angle-down arrow-down"></i>
                            </h2>
                        </div>
                        <div class="categories_menu_inner_horizontal">
                            <ul>
                                @php
                                $i=1;
                                @endphp

                                @foreach($categories as $category)
                                @php
                                $count = count($category->subs_order_by);
                                @endphp
                                <li class="{{$count ? 'dropdown_list':''}}
                                        {{ $i >= 15 ? 'rx-child' : '' }}">

                                    @if($count)
                                    @if($category->photo)
                                    <div class="img">
                                        <img src="{{ asset('storage/images/categories/'.$category->photo) }}" alt="">
                                    </div>
                                    @endif
                                    <div class="link-area">
                                        <span><a class="color2" href="{{ route('front.category',$category->slug) }}">
                                                {{ $category->name }}</a>
                                        </span>

                                        @if($count)
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </div>
                                    @else
                                    <a class="color2" href="{{ route('front.category',$category->slug) }}">
                                        @if($category->photo)
                                        <img src="{{ asset('storage/images/categories/'.$category->photo) }}">
                                        @endif
                                        {{ $category->name }}
                                    </a>
                                    @endif

                                    @if($count)
                                    @php
                                    $ck = 0;

                                    foreach($category->subs_order_by as $subcat):
                                    if(count($subcat->childs_order_by) > 0):
                                    $ck = 1;
                                    break;
                                    endif;
                                    endforeach;

                                    @endphp

                                    <ul
                                        class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">

                                        @foreach($category->subs_order_by as $subcat)
                                        <li>
                                            <a href="{{ route('front.subcat',
                                                            ['slug1' => $category->slug,
                                                            'slug2' => $subcat->slug]) }}">
                                                {{$subcat->name}}
                                            </a>

                                            @if(count($subcat->childs_order_by) > 0)
                                            <div class="categorie_sub_menu">
                                                <ul>
                                                    @foreach($subcat->childs_order_by as $childcat)
                                                    <li>
                                                        <a href="{{ route('front.childcat',
                                                                                ['slug1' => $category->slug,
                                                                                'slug2' => $subcat->slug,
                                                                                'slug3' => $childcat->slug]) }}">
                                                            {{$childcat->name}}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </li>
                                        @endforeach

                                    </ul>

                                    @endif

                                </li>

                                @php
                                $i++;
                                @endphp

                                @if($i == 8)
                                <li>
                                    <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i>
                                        {{ __("See All Categories") }}
                                    </a>
                                </li>
                                @break
                                @endif

                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!--categorie menu end-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--Main-Menu Area End-->
