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
                            <img class="logoHeader" src="{{ $gs->logoUrl }}" alt="">
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
                        <svg class="img-fluid peopleIcon" width="50" height="50" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 42C33.9411 42 42 33.9411 42 24C42 14.0589 33.9411 6 24 6C14.0589 6 6 14.0589 6 24C6 33.9411 14.0589 42 24 42ZM24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44Z" fill="currentColor"/>
                                <path d="M12 35.6309C12 34.5972 12.772 33.7241 13.7995 33.6103C21.515 32.7559 26.5206 32.8325 34.218 33.6287C35.2324 33.7337 36 34.5918 36 35.6116C36 36.1807 35.7551 36.7275 35.3262 37.1014C26.2414 45.0195 21.0488 44.9103 12.6402 37.1087C12.2306 36.7286 12 36.1897 12 35.6309Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M34.1151 34.6234C26.4784 33.8334 21.5449 33.7587 13.9095 34.6042C13.3954 34.6612 13 35.1002 13 35.6309C13 35.9171 13.1187 36.1885 13.3204 36.3757C17.4879 40.2423 20.6461 41.9887 23.7333 41.9999C26.8309 42.0113 30.1592 40.2783 34.6691 36.3476C34.8767 36.1667 35 35.8964 35 35.6116C35 35.0998 34.6154 34.6752 34.1151 34.6234ZM13.6894 32.6164C21.4852 31.7531 26.5628 31.8315 34.3209 32.6341C35.8495 32.7922 37 34.0838 37 35.6116C37 36.465 36.6336 37.2884 35.9832 37.8553C31.4083 41.8426 27.598 44.0141 23.726 43.9999C19.8435 43.9857 16.2011 41.7767 11.9601 37.8418C11.3425 37.2688 11 36.4624 11 35.6309C11 34.0943 12.1487 32.787 13.6894 32.6164Z" fill="#333333"/>
                            <path d="M32 20C32 24.4183 28.4183 28 24 28C19.5817 28 16 24.4183 16 20C16 15.5817 19.5817 12 24 12C28.4183 12 32 15.5817 32 20Z" fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 26C27.3137 26 30 23.3137 30 20C30 16.6863 27.3137 14 24 14C20.6863 14 18 16.6863 18 20C18 23.3137 20.6863 26 24 26ZM24 28C28.4183 28 32 24.4183 32 20C32 15.5817 28.4183 12 24 12C19.5817 12 16 15.5817 16 20C16 24.4183 19.5817 28 24 28Z" fill="currentColor"/>
                        </svg>
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

                      

                            <li class="wishlist" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Wish') }}">

                                @if (Auth::guard('web')->check())
                                    <a href="{{ route('user-wishlists') }}" class="wish">
                                        <svg class="img-fluid icons-header" width="40" height=40"
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
                                        <svg class="img-fluid icons-header" width="40" height="40"
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

                            @if ($gs->is_cart)
                                <li class="my-dropdown">
                                    <a href="javascript:;" class="cart carticon">
                                        <div class="icon">
                                        <svg class="img-fluid icons-header" width="40" height="40" fill="currentColor" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 6.82666 6.82666" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs></defs><g id="Layer_x0020_1"><path class="fil0" d="M1.55535 2.08935l0.545213 0c-0.0629055,0.296634 -0.0871063,0.604571 -0.0871063,0.901752 0,0.0883346 0.0716614,0.159996 0.159996,0.159996 0.0883346,0 0.159996,-0.0716614 0.159996,-0.159996 0,-0.296043 0.0249724,-0.606878 0.0939606,-0.901752l1.86312 0c0.0689921,0.294874 0.0939606,0.605709 0.0939606,0.901752 0,0.0883346 0.0716614,0.159996 0.159996,0.159996 0.0883346,0 0.159996,-0.0716614 0.159996,-0.159996 0,-0.297181 -0.0242008,-0.605118 -0.0871063,-0.901752l0.568992 0c0.0430472,0 0.0781535,0.0340039 0.0799252,0.0766181l0.295819 3.60532 6.69291e-005 -3.93701e-006c0.00361024,0.0440315 -0.0291575,0.0826654 -0.073189,0.0862756 -0.00223622,0.000185039 -0.00445669,0.000267717 -0.00666142,0.000267717l-4.22365 0c-0.0441811,0 -0.08,-0.0358189 -0.08,-0.08 0,-0.00337008 0.000208661,-0.00668504 0.000614173,-0.00994488l0.295776 -3.60478 0.079689 0.00625197 -0.0797323 -0.00654331c0.00344488,-0.0420354 0.038815,-0.0738071 0.0803268,-0.0734567z"/><path class="fil0" d="M2.09345 2.9911c0,0.0441811 0.0358189,0.08 0.08,0.08 0.0441811,0 0.08,-0.0358189 0.08,-0.08 0,-1.01507 0.293035,-1.66029 0.668114,-1.93883 0.13865,-0.102961 0.28835,-0.154445 0.437406,-0.154445 0.149051,0 0.298756,0.0514843 0.437402,0.154449 0.375075,0.278531 0.668114,0.923744 0.668114,1.93882 0,0.0441811 0.0358189,0.08 0.08,0.08 0.0441811,0 0.08,-0.0358189 0.08,-0.08 0,-1.07127 -0.321547,-1.76132 -0.733114,-2.06695 -0.16726,-0.124213 -0.349512,-0.186323 -0.532402,-0.186323 -0.182886,0 -0.365142,0.0621063 -0.532406,0.186319 -0.411567,0.305638 -0.733114,0.995693 -0.733114,2.06695z"/></g><rect class="fil1"/></svg>
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
        <div class="container-fluid">
            <div class="row mainmenu-area-innner">
                <div class="col-6 col-lg-12 d-flex justify-content-center align-items-center">
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
                                                        {{ $category->name }} </a>
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
                                                    {{ $category->name }} <i class="fa fa-angle-down icoAcess" aria-hidden="true"></i></a>
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
        <div class="col-6 col-lg-2">
            <div class="box-button-site" data-menu-toggle-main="#menu-browse-site">
                <i class="fas fa-bars"></i>
                <p>{{ __('Browse the site') }}</p>
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
