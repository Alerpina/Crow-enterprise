<section class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content">
                    <div class="left-content">
                        <div class="list">
                            <ul>
                                @if (config('features.lang_switcher') && $gs->is_language == 1)
                                    <li class="separador-right">
                                        <div class="language-selector">
                                            <i class="fas fa-globe-americas"></i>
                                            <select name="language" class="language selectors nice">
                                                @foreach ($locales as $language)
                                                    <option value="{{ route('front.language', $language->id) }}"
                                                        {{ $slocale->id == $language->id ? 'selected' : '' }}>
                                                        {{ $language->language }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                @endif

                                @if ($gs->show_currency_values == 1)
                                    @php
                                        $top_first_curr = $curr;
                                        $top_curr = $scurrency;
                                    @endphp

                                    @if ($scurrency->id != 1)
                                        <li>
                                            <div class="currency-selector">
                                                <span><i class="fas fa-coins"></i>
                                                    {{ __('Currency Rate') }}:
                                                    {{ $top_first_curr->sign . number_format($top_first_curr->value, $top_first_curr->decimal_digits, $top_first_curr->decimal_separator, $top_first_curr->thousands_separator) }}
                                                    =
                                                    {{ $top_curr->sign . ' ' . number_format($top_curr->value, $top_curr->decimal_digits, $top_curr->decimal_separator, $top_curr->thousands_separator) }}
                                                </span>
                                            </div>
                                        </li>
                                    @endif
                                @endif

                                @if (Auth::guard('admin')->check())
                                    <li>
                                        <div class="mybadge1">
                                            <a href="{{ route('admin.logout') }}">
                                                {{ __('Viewing as Admin') }}
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
                                <!--MOEDA-->
                                @if (config('features.currency_switcher') && $gs->is_currency == 1)
                                    <li>
                                        <div class="currency-selector" style="padding-right:12px;">
                                            <select name="currency" class="currency selectors nice">
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ route('front.currency', $currency->id) }}"
                                                        {{ $scurrency->id == $currency->id ? 'selected' : '' }}>
                                                        {{ $currency->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                @endif
                                <!--FINAL DA MOEDA-->
                                @if (config('features.productsListPdf'))
                                    <li class="login ml-0 separador-left">
                                        <a target="_blank" href="{{ route('download-list-pdf') }}">
                                            <div class="links">
                                                {{ __('Products list - PDF') }}
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
            <div class="row justify-content-around" style="position: relative;">

                <div class="col-lg-3 col-5 order-2 order-lg-1">
                    <div class="logo">
                        <a href="{{ route('front.index') }}">
                            <img src="{{ $gs->logoUrl }}" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-2 order-1 order-lg-2" style="position: static;">
                    <div class="button-open-search">
                        <input type="checkbox">
                        <i class="icofont-search-1"></i>
                    </div>
                    <div class="search-box-wrapper">
                        <div class="search-box">
                            <form id="searchForm" class="search-form" action="{{ route('front.category') }}"
                                method="GET">

                                <button type="submit"><i class="icofont-search-1"></i></button>

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
                                    placeholder="{{ __('What are you looking for?') }}"
                                    value="{{ request()->input('searchHttp') }}" autocomplete="off">
                                <div class="autocomplete">
                                    <div id="myInputautocomplete-list" class="autocomplete-items"></div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-8 col-lg-2 order-4 order-lg-3">
                    <!--PARTE DO LOGIN-->
                    @if (!Auth::guard('web')->check())
                        <a href="{{ route('user.login') }}" id="profile-icon" class="profile carticon">
                            <i class="fas fa-user-circle"></i>
                            <span class="text">
                                {{ __('Enter or register') }}
                            </span>
                        </a>
                    @else
                        <a href="{{ route('user-dashboard') }}" id="profile-icon" class="profile carticon">
                            <i class="fas fa-user-circle"></i>
                            <span class="text" style="width:100%">
                                {{ __('Hello') }},
                                {{ Auth::user()->name }}
                                <small class="d-block">{{ __('Access your account') }}</small>
                            </span>
                        </a>

                        {{-- @if (config('features.marketplace'))
                        @if (Auth::user()->IsVendor())
                            <li>
                                <a href="{{ route('vendor-dashboard') }}">
                                    <i class="fas fa-caret-right"></i>
                                    {{ __("Vendor Panel") }}
                                </a>
                            </li>
                        @endif
                        @endif --}}
                    @endif
                    <!--FINAL DO LOGIN-->
                </div>

                <div class="col-5 col-lg-2 order-3 col-sm-6 order-lg-4">
                    <div class="helpful-links">
                        <ul class="helpful-links-inner">

                            @if ($gs->is_cart)
                                <li class="my-dropdown">
                                    <a href="javascript:;" class="cart carticon">
                                        <div class="icon">
                                            <svg class="img-fluid icons-header" width="30" height="30"
                                                viewBox="0 0 30 30" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M26.35 8.75C26.134 8.37577 25.8247 8.06392 25.4523 7.84484C25.0799 7.62577 24.657 7.50696 24.225 7.5H8.225L7.5 4.675C7.42675 4.4023 7.26333 4.16243 7.03635 3.99447C6.80937 3.8265 6.5322 3.74033 6.25 3.75H3.75C3.41848 3.75 3.10054 3.8817 2.86612 4.11612C2.6317 4.35054 2.5 4.66848 2.5 5C2.5 5.33152 2.6317 5.64946 2.86612 5.88388C3.10054 6.1183 3.41848 6.25 3.75 6.25H5.3L8.75 19.075C8.82325 19.3477 8.98667 19.5876 9.21365 19.7555C9.44063 19.9235 9.7178 20.0097 10 20H21.25C21.4808 19.9993 21.707 19.9347 21.9033 19.8133C22.0997 19.692 22.2586 19.5186 22.3625 19.3125L26.4625 11.1125C26.6402 10.74 26.7229 10.3293 26.7033 9.9171C26.6837 9.50487 26.5623 9.10391 26.35 8.75Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M9.375 26.25C10.4105 26.25 11.25 25.4105 11.25 24.375C11.25 23.3395 10.4105 22.5 9.375 22.5C8.33947 22.5 7.5 23.3395 7.5 24.375C7.5 25.4105 8.33947 26.25 9.375 26.25Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M21.875 26.25C22.9105 26.25 23.75 25.4105 23.75 24.375C23.75 23.3395 22.9105 22.5 21.875 22.5C20.8395 22.5 20 23.3395 20 24.375C20 25.4105 20.8395 26.25 21.875 26.25Z"
                                                    fill="currentColor" />
                                            </svg>

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

                            <li class="wishlist" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Wish') }}">

                                @if (Auth::guard('web')->check())
                                    <a href="{{ route('user-wishlists') }}" class="wish">
                                        <svg class="img-fluid icons-header" width="30" height="30"
                                            viewBox="0 0 30 30" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z"
                                                fill="currentColor" />
                                        </svg>

                                        <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                    </a>
                                @else
                                    <a href="javascript:;" data-toggle="modal" id="wish-btn"
                                        data-target="#comment-log-reg" class="wish">
                                        <svg class="img-fluid icons-header" width="30" height="30"
                                            viewBox="0 0 30 30" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span id="wishlist-count">0</span>
                                    </a>
                                @endif

                            </li>

                            <li class="compare" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Compare') }}">
                                <a href="{{ route('product.compare') }}" class="wish compare-product">
                                    <div class="icon">
                                        <svg class="img-fluid icons-header" width="30" height="30"
                                            viewBox="0 0 30 30" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 17.5L13.75 11.25L20 5L21.75 6.78125L18.5313 10H27.5V12.5H18.5313L21.75 15.7188L20 17.5ZM10 25L16.25 18.75L10 12.5L8.25 14.2813L11.4688 17.5H2.5V20H11.4688L8.25 23.2188L10 25Z"
                                                fill="currentColor" />
                                        </svg>

                                        <span id="compare-count">
                                            {{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}
                                        </span>
                                    </div>
                                </a>
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
            <div class="row mainmenu-area-innner">
                <div class="col-6 col-lg-2 order-2 order-lg-1 pl-0 pl-md-3">
                    <div class="box-button-site" data-menu-toggle-main="#menu-browse-site">
                        <p><i class="fas fa-bars"></i> {{ __('Browse the site') }}</p>
                        <div id="menu-browse-site" class="container-menu">
                            <ul>
                                <li>
                                    <a href="{{ route('front.brands') }}">
                                        {{ __('Brands') }}
                                        <i class="fas fa-caret-right"></i>
                                    </a>
                                </li>
                                @if ($gs->is_blog == 1)
                                    <li>
                                        <a href="{{ route('front.blog') }}">
                                            {{ __('Blog') }}
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ($gs->is_faq == 1)
                                    <li>
                                        <a href="{{ route('front.faq') }}">
                                            {{ __('Faq') }}
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                @endif
                                @if ($gs->policy)
                                    <li>
                                        <a href="{{ route('front.policy') }}">
                                            {{ __('Buy & Return Policy') }}
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($pheader as $data)
                                    <li>
                                        <a href="{{ route('front.page', $data->slug) }}">
                                            {{ $data->title }}
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                @endforeach

                                @if ($gs->is_contact == 1)
                                    <li>
                                        <a href="{{ route('front.contact') }}">
                                            {{ __('Contact Us') }}
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ($gs->is_cart)
                                    <li>
                                        <a href="javascript:;" data-toggle="modal" data-target="#track-order-modal">
                                            {{ __('Track Order') }}
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ($gs->team_show_header == 1)
                                    <li>
                                        <a href="{{ route('front.team_member') }}">
                                            {{ __('Team') }}
                                            <i class="fas fa-caret-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-6 col-lg-10 order-1 order-lg-2 d-flex justify-content-center align-items-center">
                    <!--categorie menu start-->
                    <div class="categories_menu vertical">
                        <div class="categories_title">
                            <h2 class="categori_toggle"><i class="fas fa-layer-group"></i> {{ __('Categories') }}
                                <i class="fa fa-angle-down arrow-down"></i>
                            </h2>
                        </div>
                        <div class="categories_menu_inner">
                            <ul style="width:100%;">
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($categories as $category)
                                    @php
                                        $count = count($category->subs_order_by);
                                    @endphp
                                    <li
                                        class="{{ $count ? 'dropdown_list' : '' }}
                                        {{ $i >= 15 ? 'rx-child' : '' }} qntd">

                                        @if ($count)
                                            @if ($category->photo)
                                                <div class="img">
                                                    <img src="{{ asset('storage/images/categories/' . $category->photo) }}"
                                                        alt="">
                                                </div>
                                            @endif
                                            <div class="link-area">
                                                <span><a href="{{ route('front.category', $category->slug) }}">
                                                        {{ $category->name }}</a>
                                                </span>

                                                @if ($count)
                                                    <a href="javascript:;">
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <a href="{{ route('front.category', $category->slug) }}">
                                                @if ($category->photo)
                                                    <img
                                                        src="{{ asset('storage/images/categories/' . $category->photo) }}">
                                                @endif
                                                {{ $category->name }}
                                            </a>
                                        @endif

                                        @if ($count)
                                            @php
                                                $ck = 0;

                                                foreach ($category->subs_order_by as $subcat):
                                                    if (count($subcat->childs_order_by) > 0):
                                                        $ck = 1;
                                                        break;
                                                    endif;
                                                endforeach;

                                            @endphp

                                            <ul
                                                class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">

                                                @foreach ($category->subs_order_by as $subcat)
                                                    <li>
                                                        <a
                                                            href="{{ route('front.subcat', ['slug1' => $category->slug, 'slug2' => $subcat->slug]) }}">
                                                            {{ $subcat->name }}
                                                        </a>

                                                        @if (count($subcat->childs_order_by) > 0)
                                                            <div class="categorie_sub_menu">
                                                                <ul>
                                                                    @foreach ($subcat->childs_order_by as $childcat)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('front.childcat', ['slug1' => $category->slug, 'slug2' => $subcat->slug, 'slug3' => $childcat->slug]) }}">
                                                                                {{ $childcat->name }}
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

                                    @if ($i == 15)
                                        <li>
                                            <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i>
                                                {{ __('See All Categories') }}
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
                            <h2 class="categori_toggle"><i class="fa fa-bars"></i> {{ __('Categories') }}
                                <i class="fa fa-angle-down arrow-down"></i>
                            </h2>
                        </div>
                        <div class="categories_menu_inner_horizontal">
                            <ul>
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($categories as $category)
                                    @php
                                        $count = count($category->subs_order_by);
                                    @endphp
                                    <li
                                        class="{{ $count ? 'dropdown_list' : '' }}
                                            {{ $i >= 15 ? 'rx-child' : '' }}">

                                        @if ($count)
                                            @if ($category->photo)
                                                <div class="img">
                                                    <img src="{{ asset('storage/images/categories/' . $category->photo) }}"
                                                        alt="">
                                                </div>
                                            @endif
                                            <div class="link-area">
                                                <span><a href="{{ route('front.category', $category->slug) }}">
                                                        {{ $category->name }}</a>
                                                </span>

                                                @if ($count)
                                                    <a href="javascript:;">
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <a href="{{ route('front.category', $category->slug) }}">
                                                @if ($category->photo)
                                                    <img
                                                        src="{{ asset('storage/images/categories/' . $category->photo) }}">
                                                @endif
                                                {{ $category->name }}
                                            </a>
                                        @endif

                                        @if ($count)
                                            @php
                                                $ck = 0;

                                                foreach ($category->subs_order_by as $subcat):
                                                    if (count($subcat->childs_order_by) > 0):
                                                        $ck = 1;
                                                        break;
                                                    endif;
                                                endforeach;

                                            @endphp

                                            <ul
                                                class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">

                                                @foreach ($category->subs_order_by as $subcat)
                                                    <li>
                                                        <a
                                                            href="{{ route('front.subcat', ['slug1' => $category->slug, 'slug2' => $subcat->slug]) }}">
                                                            {{ $subcat->name }}
                                                        </a>

                                                        @if (count($subcat->childs_order_by) > 0)
                                                            <div class="categorie_sub_menu">
                                                                <ul>
                                                                    @foreach ($subcat->childs_order_by as $childcat)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('front.childcat', ['slug1' => $category->slug, 'slug2' => $subcat->slug, 'slug3' => $childcat->slug]) }}">
                                                                                {{ $childcat->name }}
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

                                    @if ($i == 6)
                                        <li>
                                            <a href="#" class="open-more-categ""><i class="fas fa-plus"></i>
                                                {{ __('See All Categories') }}
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

<!-- Menu lateral de todas as categorias -->
<div class="box-menu-lateral-categorias">
<div class="bg-fade-menu-lateral"></div>
<ul class="menu-lateral-categorias">
@foreach ($categories as $category)
    <li class="category-item">
        @if ($category->photo)
            <img style="max-width:20px;margin-right:5px;"
                src="{{ asset('storage/images/categories/' . $category->photo) }}">
        @endif
        <a href="{{ route('front.category', $category->slug) }}">{{ $category->name }}</a>

        {{-- Menu subcategoria --}}
        @foreach ($category->subs_order_by as $subcategory)
            <ul>
                <li>
                    <a
                        href="{{ route('front.subcat', ['slug1' => $category->slug, 'slug2' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>

                    {{-- Menu Categorias Filhas --}}
                    @foreach ($subcategory->childs_order_by as $childcategory)
                        <ul>
                            <li>
                                <a
                                    href="{{ route('front.childcat', ['slug1' => $category->slug, 'slug2' => $subcategory->slug, 'slug3' => $childcategory->slug]) }}">{{ $childcategory->name }}</a>
                            </li>
                        </ul>
                    @endforeach

                </li>
            </ul>
        @endforeach

    </li>
@endforeach

</ul>

</div>
