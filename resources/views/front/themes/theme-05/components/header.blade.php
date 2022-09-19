<section class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
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
                                                    {{ $top_curr->sign .
                                                        ' ' .
                                                        number_format(
                                                            $top_curr->value,
                                                            $top_curr->decimal_digits,
                                                            $top_curr->decimal_separator,
                                                            $top_curr->thousands_separator,
                                                        ) }}
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

                                <!--PARTE DO LOGIN-->
                                @if (!Auth::guard('web')->check())

                                    <li class="openperfil profilearea my-dropdown separador-right">
                                        <a href="javascript: ;" id="profile-icon" class="profile carticon">
                                            <span class="text">
                                                {{ __('Account') }}
                                                <i class="fas fa-caret-down"></i>
                                            </span>
                                        </a>
                                        <div class="my-dropdown-menu profile-dropdown">
                                            <ul class="profile-links">
                                                <li>
                                                    <a href="{{ route('user.login') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Sign in') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user.login') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Join') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li class="openperfil profilearea my-dropdown separador-right">
                                        <a href="javascript: ;" id="profile-icon" class="profile carticon">
                                            <span class="text">
                                                {{ __('Account') }}
                                                <i class="fas fa-caret-down"></i>
                                            </span>
                                        </a>
                                        <div class="my-dropdown-menu profile-dropdown">
                                            <ul class="profile-links">
                                                <li>
                                                    <a href="{{ route('user-dashboard') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('User Panel') }}
                                                    </a>
                                                </li>

                                                @if (config('features.marketplace'))
                                                    @if (Auth::user()->IsVendor())
                                                        <li>
                                                            <a href="{{ route('vendor-dashboard') }}">
                                                                <i class="fas fa-caret-right"></i>
                                                                {{ __('Vendor Panel') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif

                                                <li>
                                                    <a href="{{ route('user-profile') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Edit Profile') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user-logout') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Logout') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                <!--FINAL DO LOGIN-->

                                <li class="openstore profilearea my-dropdown separador-right">
                                    <a href="javascript: ;" id="profile-icon" class="profile carticon">
                                        <span class="text">
                                            {{ __('Our Store') }}
                                            <i class="fas fa-caret-down"></i>
                                        </span>
                                    </a>
                                    <div class="my-dropdown-menu profile-dropdown">
                                        <ul class="profile-links">
                                            <li>
                                                <a href="{{ route('front.brands') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __('Brands') }}
                                                </a>
                                            </li>
                                            @if ($gs->is_blog == 1)
                                                <li>
                                                    <a href="{{ route('front.blog') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Blog') }}
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($gs->is_faq == 1)
                                                <li>
                                                    <a href="{{ route('front.faq') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Faq') }}
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($gs->policy)
                                                <li>
                                                    <a href="{{ route('front.policy') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Buy & Return Policy') }}
                                                    </a>
                                                </li>
                                            @endif

                                            @foreach ($pheader as $data)
                                                <li>
                                                    <a href="{{ route('front.page', $data->slug) }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ $data->title }}
                                                    </a>
                                                </li>
                                            @endforeach

                                            @if ($gs->is_contact == 1)
                                                <li>
                                                    <a href="{{ route('front.contact') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Contact Us') }}
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($gs->is_cart)
                                                <li>
                                                    <a href="javascript:;" data-toggle="modal"
                                                        data-target="#track-order-modal">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Track Order') }}
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($gs->team_show_header == 1)
                                                <li>
                                                    <a href="{{ route('front.team_member') }}">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ __('Team') }}
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>

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
            <div class="row justify-content-around">

                <div class="col-8 col-lg-12 remove-padding">
                    <div class="logo">
                        <a href="{{ route('front.index') }}">
                            <img src="{{ asset('storage/images/' . $gs->logo) }}" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3">
                </div>

                <div class="col-lg-6 col-sm-12 remove-padding">
                    <div class="search-box-wrapper">
                        <div class="search-box">
                            <form id="searchForm" class="search-form" action="{{ route('front.category') }}"
                                method="GET">

                                @if (!empty(request()->input('sort')))
                                    <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                                @endif

                                @if (!empty(request()->input('minprice')))
                                    <input type="hidden" name="minprice"
                                        value="{{ request()->input('minprice') }}">
                                @endif

                                @if (!empty(request()->input('maxprice')))
                                    <input type="hidden" name="maxprice"
                                        value="{{ request()->input('maxprice') }}">
                                @endif

                                <input type="text" id="prod_name" name="searchHttp"
                                    placeholder="{{ __('Search For Product') }}"
                                    value="{{ request()->input('searchHttp') }}" autocomplete="off">
                                <div class="autocomplete">
                                    <div id="myInputautocomplete-list" class="autocomplete-items"></div>
                                </div>
                                <button type="submit">Pesquisar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 remove-padding">
                    <div class="helpful-links">
                        <ul class="helpful-links-inner">

                            @if ($gs->is_cart)
                                <li class="my-dropdown">
                                    <a href="javascript:;" class="cart carticon">
                                        <div class="icon">
                                            <svg class="icons-header" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                y="0px" width="496.971px" height="496.971px"
                                                viewBox="0 0 496.971 496.971"
                                                style="enable-background:new 0 0 496.971 496.971;"
                                                xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <rect x="249.231" y="230.676" width="110.437"
                                                            height="58.41" />
                                                        <polygon
                                                            points="219.383,132.183 129.481,132.183 136.166,200.831 219.383,200.831 " />
                                                        <polygon
                                                            points="219.383,289.086 219.383,230.679 139.074,230.679 144.763,289.086 " />
                                                        <polygon
                                                            points="219.383,43.923 120.884,43.923 126.573,102.335 219.383,102.335 " />
                                                        <polygon
                                                            points="389.516,289.086 449.213,289.086 460.592,230.679 389.516,230.679 " />
                                                        <rect x="249.231" y="43.923" width="110.437"
                                                            height="58.41" />
                                                        <rect x="249.231" y="132.183" width="110.437"
                                                            height="68.646" />
                                                        <polygon
                                                            points="389.516,102.335 485.592,102.335 496.971,43.923 389.516,43.923 " />
                                                        <polygon
                                                            points="389.516,200.831 466.406,200.831 479.777,132.183 389.516,132.183 " />
                                                        <polygon
                                                            points="89.858,28.999 0,28.999 0,58.847 62.367,58.847 86.246,348.784 449.213,348.784 449.213,318.937 113.736,318.937" />
                                                        <circle cx="133.57" cy="422.453" r="45.519" />
                                                        <circle cx="394.74" cy="422.453" r="45.519" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="cart-quantity" id="cart-count">
                                                {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
                                            </span>
                                        </div>
                                    </a>
                                    <div class="my-dropdown-menu" id="cart-items">
                                        <i id="arrow_cart" class="fas fa-caret-up"></i>
                                        @include('load.cart')
                                    </div>
                                </li>
                            @endif

                            <li class="wishlist" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Wish') }}">

                                @if (Auth::guard('web')->check())
                                    <a href="{{ route('user-wishlists') }}" class="wish">
                                        <svg class="icons-header" version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M378.667,21.333c-56.792,0-103.698,52.75-122.667,77.646c-18.969-24.896-65.875-77.646-122.667-77.646
                                                    C59.813,21.333,0,88.927,0,172c0,45.323,17.99,87.562,49.479,116.469c0.458,0.792,1.021,1.521,1.677,2.177l197.313,196.906
                                                    c2.083,2.073,4.802,3.115,7.531,3.115s5.458-1.042,7.542-3.125L467.417,283.74l2.104-2.042c1.667-1.573,3.313-3.167,5.156-5.208
                                                    c0.771-0.76,1.406-1.615,1.896-2.542C499.438,245.948,512,209.833,512,172C512,88.927,452.188,21.333,378.667,21.333z
                                                    M458.823,261.948c-0.292,0.344-0.563,0.708-0.802,1.083c-1,1.146-2.094,2.156-3.177,3.188L255.99,464.927L68.667,277.979
                                                    c-0.604-1.188-1.448-2.271-2.479-3.177C37.677,249.906,21.333,212.437,21.333,172c0-71.313,50.24-129.333,112-129.333
                                                    c61.063,0,113.177,79.646,113.698,80.448c3.938,6.083,14,6.083,17.938,0c0.521-0.802,52.635-80.448,113.698-80.448
                                                    c61.76,0,112,58.021,112,129.333C490.667,205.604,479.354,237.552,458.823,261.948z" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                    </a>
                                @else
                                    <a href="javascript:;" data-toggle="modal" id="wish-btn"
                                        data-target="#comment-log-reg" class="wish">
                                        <svg class="icons-header" version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M378.667,21.333c-56.792,0-103.698,52.75-122.667,77.646c-18.969-24.896-65.875-77.646-122.667-77.646
                                                    C59.813,21.333,0,88.927,0,172c0,45.323,17.99,87.562,49.479,116.469c0.458,0.792,1.021,1.521,1.677,2.177l197.313,196.906
                                                    c2.083,2.073,4.802,3.115,7.531,3.115s5.458-1.042,7.542-3.125L467.417,283.74l2.104-2.042c1.667-1.573,3.313-3.167,5.156-5.208
                                                    c0.771-0.76,1.406-1.615,1.896-2.542C499.438,245.948,512,209.833,512,172C512,88.927,452.188,21.333,378.667,21.333z
                                                    M458.823,261.948c-0.292,0.344-0.563,0.708-0.802,1.083c-1,1.146-2.094,2.156-3.177,3.188L255.99,464.927L68.667,277.979
                                                    c-0.604-1.188-1.448-2.271-2.479-3.177C37.677,249.906,21.333,212.437,21.333,172c0-71.313,50.24-129.333,112-129.333
                                                    c61.063,0,113.177,79.646,113.698,80.448c3.938,6.083,14,6.083,17.938,0c0.521-0.802,52.635-80.448,113.698-80.448
                                                    c61.76,0,112,58.021,112,129.333C490.667,205.604,479.354,237.552,458.823,261.948z" />
                                                </g>
                                            </g>
                                        </svg>
                                        <span id="wishlist-count">0</span>
                                    </a>
                                @endif

                            </li>

                            <li class="compare" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Compare') }}">
                                <a href="{{ route('product.compare') }}" class="wish compare-product">
                                    <div class="icon">
                                        <svg class="icons-header" version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 368.008 368.008"
                                            style="enable-background:new 0 0 368.008 368.008;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M39.316,207.968c0.232,0.024,0.464,0.032,0.696,0.032c3.848,0,7.2-2.776,7.872-6.64
                                                            c0.464-2.664,12.064-65.352,72.12-65.352h112v32c0,3.168,1.864,6.032,4.768,7.32c2.896,1.28,6.272,0.736,8.616-1.4l88-80
                                                            c1.664-1.52,2.616-3.664,2.616-5.92s-0.952-4.4-2.616-5.92l-88-80c-2.344-2.136-5.728-2.688-8.616-1.4
                                                            c-2.904,1.288-4.768,4.152-4.768,7.32v40h-112c-47.696,0-88,36.64-88,80v72C32.004,204.16,35.18,207.616,39.316,207.968z
                                                            M48.004,128.008c0-34.688,32.976-64,72-64h120c4.424,0,8-3.584,8-8V26.096l68.112,61.912l-68.112,61.912v-21.912
                                                            c0-4.416-3.576-8-8-8h-120c-37.304,0-59.328,19.968-72,39.784V128.008z" />
                                                        <path
                                                            d="M328.692,160.048c-4.12-0.392-7.856,2.504-8.568,6.608c-0.472,2.664-12.064,65.352-72.12,65.352h-104v-32
                                                            c0-3.104-1.8-5.928-4.608-7.248c-2.816-1.312-6.128-0.888-8.512,1.104l-96,80c-1.824,1.52-2.88,3.768-2.88,6.144
                                                            c0,2.376,1.056,4.624,2.88,6.144l96,80c1.464,1.224,3.288,1.856,5.12,1.856c1.152,0,2.312-0.248,3.392-0.752
                                                            c2.808-1.32,4.608-4.144,4.608-7.248v-40h104c47.704,0,88-36.64,88-80v-72C336.004,163.856,332.828,160.4,328.692,160.048z
                                                            M320.004,240.008c0,34.688-32.968,64-72,64h-112c-4.416,0-8,3.584-8,8v30.92L52.5,280.008l75.504-62.92v22.92
                                                            c0,4.416,3.584,8,8,8h112c37.304,0,59.328-19.968,72-39.784V240.008z" />
                                                    </g>
                                                </g>
                                            </g>
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
            <div class="row align-items-center mainmenu-area-innner">
                <div class="col-lg-12 col-md-12 categorimenu-wrapper remove-padding">
                    <!--categorie menu start-->
                    <div class="categories_menu vertical">
                        <div class="categories_title">
                            <h2 class="categori_toggle"><i class="fa fa-bars"></i> {{ __('Categories') }}
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

                                @if ($i == 8)
                                    <li>
                                        <a href="#" class="open-more-categ"><i class="fas fa-plus"></i>
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
