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

                <div class="col-lg-2"></div>

                <div class="col-8 col-lg-8 remove-padding">
                    <div class="logo">
                        <a href="{{ route('front.index') }}">
                            <img src="{{ asset('storage/images/' . $gs->logo) }}" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-6 remove-padding">
                    <div class="helpful-links">
                        <ul class="helpful-links-inner">

                            <li class="compare" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Compare') }}">
                                <a href="{{ route('product.compare') }}" class="wish compare-product">
                                    <div class="icon">
                                        <svg class="icons-header" xmlns="http://www.w3.org/2000/svg" width="44.576"
                                            height="39.623" viewBox="0 0 44.576 39.623">
                                            <path id="comparar"
                                                d="M28.746,17.027a1.721,1.721,0,0,0-.589-1.318L15.8,5.333a1.37,1.37,0,0,0-1.559-.16,1.676,1.676,0,0,0-.823,1.479V11.1H3.485A1.574,1.574,0,0,0,2,12.753v8.553a1.575,1.575,0,0,0,1.485,1.652h9.934v4.447a1.674,1.674,0,0,0,.825,1.479,1.362,1.362,0,0,0,1.559-.162l12.356-10.38A1.723,1.723,0,0,0,28.746,17.027Zm-12.354,7.06V21.307A1.576,1.576,0,0,0,14.9,19.655H4.972V14.4H14.9a1.574,1.574,0,0,0,1.487-1.65V9.967l8.4,7.06Zm28.7,2.581H35.133v-4.45a1.676,1.676,0,0,0-.826-1.479,1.366,1.366,0,0,0-1.559.164L20.418,31.281a1.764,1.764,0,0,0,0,2.631l12.33,10.376a1.39,1.39,0,0,0,.9.335,1.353,1.353,0,0,0,.662-.173,1.68,1.68,0,0,0,.825-1.479v-4.45h9.958a1.574,1.574,0,0,0,1.485-1.652V28.32A1.575,1.575,0,0,0,45.091,26.669ZM43.6,35.22H33.646a1.574,1.574,0,0,0-1.485,1.65v2.781L23.777,32.6l8.384-7.057V28.32a1.576,1.576,0,0,0,1.485,1.652H43.6Z"
                                                transform="translate(-2 -5)" fill="#b7b7b7" />
                                        </svg>

                                        <span id="compare-count">
                                            {{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li class="wishlist" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Wish') }}">

                                @if (Auth::guard('web')->check())
                                    <a href="{{ route('user-wishlists') }}" class="wish">
                                        <svg class="icons-header" xmlns="http://www.w3.org/2000/svg" width="43.495"
                                            height="38.585" viewBox="0 0 43.495 38.585">
                                            <path id="love"
                                                d="M41.518,7.209a13.683,13.683,0,0,0-17.75-1.392A13.639,13.639,0,0,0,6.017,26.438l13.509,13.53a6.047,6.047,0,0,0,8.484,0l13.509-13.53a13.639,13.639,0,0,0,0-19.23ZM38.45,23.436,24.942,36.945a1.653,1.653,0,0,1-2.349,0L9.084,23.371A9.229,9.229,0,0,1,22.136,10.319a2.175,2.175,0,0,0,3.089,0A9.292,9.292,0,0,1,38.45,23.371Z"
                                                transform="translate(-1.988 -3.121)" fill="#b7b7b7" />
                                        </svg>
                                        <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                    </a>
                                @else
                                    <a href="javascript:;" data-toggle="modal" id="wish-btn"
                                        data-target="#comment-log-reg" class="wish">
                                        <svg class="icons-header" xmlns="http://www.w3.org/2000/svg" width="43.495"
                                            height="38.585" viewBox="0 0 43.495 38.585">
                                            <path id="love"
                                                d="M41.518,7.209a13.683,13.683,0,0,0-17.75-1.392A13.639,13.639,0,0,0,6.017,26.438l13.509,13.53a6.047,6.047,0,0,0,8.484,0l13.509-13.53a13.639,13.639,0,0,0,0-19.23ZM38.45,23.436,24.942,36.945a1.653,1.653,0,0,1-2.349,0L9.084,23.371A9.229,9.229,0,0,1,22.136,10.319a2.175,2.175,0,0,0,3.089,0A9.292,9.292,0,0,1,38.45,23.371Z"
                                                transform="translate(-1.988 -3.121)" fill="#b7b7b7" />
                                        </svg>
                                        <span id="wishlist-count">0</span>
                                    </a>
                                @endif

                            </li>

                            @if ($gs->is_cart)
                                <li class="my-dropdown">
                                    <a href="javascript:;" class="cart carticon">
                                        <div class="icon">
                                            <svg class="icons-header" xmlns="http://www.w3.org/2000/svg"
                                                width="49.999" height="39.293" viewBox="0 0 49.999 39.293">
                                                <path id="cart"
                                                    d="M49.89,19.858,44.075,38.173a3.082,3.082,0,0,1-2.935,2.174H18.7a3.2,3.2,0,0,1-2.989-2.011L7.119,15.348H2.174a2.174,2.174,0,1,1,0-4.348H8.641a2.225,2.225,0,0,1,2.065,1.467L19.565,36H40.217l4.619-14.674h-25.6a2.174,2.174,0,1,1,0-4.348H47.825a2.161,2.161,0,0,1,1.739.924,2.107,2.107,0,0,1,.326,1.956ZM19.782,43.228a3.525,3.525,0,1,0,2.5,1.033A3.584,3.584,0,0,0,19.782,43.228Zm19.51,0a3.525,3.525,0,1,0,2.5,1.033A3.584,3.584,0,0,0,39.293,43.228Z"
                                                    transform="translate(0 -11)" fill="#b7b7b7" />
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


                        </ul>
                    </div>
                </div>

                <div class="col-lg-8 col-sm-12 remove-padding">
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
                                <button type="submit">Buscar</button>
                            </form>
                        </div>
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
            <!--categorie menu end-->
        </div>
    </div>
</div>
</div>
</div>
<!--Main-Menu Area End-->
