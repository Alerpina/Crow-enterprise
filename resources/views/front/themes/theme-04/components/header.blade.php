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
                                    <li clas='separador-left'>
                                        <a target="_blank" href="{{ route('download-list-pdf') }}">
                                            <span class="text" style="font-size: 12px">
                                                {{ __('Products list - PDF') }}
                                                <i class="fas fa-download"></i>
                                            </span>
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
        <div class="container" style="position: relative;">

            <svg class="svg-header" viewBox="0 0 1380 90">
                <path d="M 0 15 15 0 1365 0 1380 15 1380 75 1365 90 15 90 0 75 Z"></path>
            </svg>

            <!--<svg class="svg-header" viewBox="0 0 1300 75">
                    <path d="M 0 15 15 0 1285 0 1300 15 1300 60 1285 75 15 75 0 60 Z"></path>
                </svg> -->
            <div class="row justify-content-center" style="position: relative;">
                <div class="col-xl-2 col-lg-3 col-6 pr-0">
                    <!--Main-Menu Area Start-->
                    <div class="mainmenu-area mainmenu-bb">
                        <div>
                            <div class="mainmenu-area-innner">
                                <div class="categorimenu-wrapper">
                                    <!--categorie menu start-->
                                    <div class="categories_menu">
                                        <svg class='svg-button'>
                                            <path d='M 0 10 10 0 150 0 160 10 160 30 150 40 10 40 0 30 Z' />
                                        </svg>
                                        <div class="categories_title">
                                            <h2 class="categori_toggle"><i class="fa fa-bars"></i>
                                                {{ __('Categories') }}

                                            </h2>
                                        </div>
                                        <div class="categories_menu_inner">
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
                                                            {{ $i >= 15 ? 'rx-child' : '' }} qntd">

                                                        @if ($count)
                                                            @if ($category->photo)
                                                                <div class="img">
                                                                    <img src="{{ asset('storage/images/categories/' . $category->photo) }}"
                                                                        alt="">
                                                                </div>
                                                            @endif
                                                            <div class="link-area">
                                                                <span><a
                                                                        href="{{ route('front.category', $category->slug) }}">
                                                                        {{ $category->name }}</a>
                                                                </span>

                                                                @if ($count)
                                                                    <a href="javascript:;">
                                                                        <i class="fa fa-angle-right"
                                                                            aria-hidden="true"></i>
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
                                                            <a href="{{ route('front.categories') }}"><i
                                                                    class="fas fa-plus"></i>
                                                                {{ __('See All Categories') }}
                                                            </a>
                                                        </li>
                                                    @break
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-2 col-lg-3 col-sm-6 col-6 remove-padding">
                <div class="helpful-links">
                    <ul class="helpful-links-inner">

                        @if ($gs->is_cart)
                            <li class="my-dropdown">
                                <a href="javascript:;" class="cart carticon">
                                    <div class="icon">
                                        <svg class='svg-button' viewBox>
                                            <path d='M 0 10 10 0 30 0 40 10 40 50 30 60 10 60 0 50 Z' />
                                        </svg>
                                        <span class="cart-quantity" id="cart-count">
                                            {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
                                        </span>
                                        <img src="{{ asset('assets/front/themes/theme-04/assets/images/cartheader.png') }}"
                                            class="img-fluid icons-header" alt="Carrinho">
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
                                    <svg class='svg-button'>
                                        <path d='M 0 10 10 0 30 0 40 10 40 50 30 60 10 60 0 50 Z' />
                                    </svg>
                                    <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                    <img src="{{ asset('assets/front/themes/theme-04/assets/images/loveheader.png') }}"
                                        class="img-fluid icons-header" alt="Amei">
                                </a>
                            @else
                                <a href="javascript:;" data-toggle="modal" id="wish-btn"
                                    data-target="#comment-log-reg" class="wish">
                                    <svg class='svg-button'>
                                        <path d='M 0 10 10 0 30 0 40 10 40 50 30 60 10 60 0 50 Z' />
                                    </svg>
                                    <span id="wishlist-count">0</span>
                                    <img src="{{ asset('assets/front/themes/theme-04/assets/images/loveheader.png') }}"
                                        class="img-fluid icons-header" alt="Amei">
                                </a>
                            @endif

                        </li>

                        <li class="compare" data-toggle="tooltip" data-placement="top"
                            title="{{ __('Compare') }}">
                            <a href="{{ route('product.compare') }}" class="wish compare-product">
                                <div class="icon">
                                    <svg class='svg-button'>
                                        <path d='M 0 10 10 0 30 0 40 10 40 50 30 60 10 60 0 50 Z' />
                                    </svg>
                                    <span id="compare-count">
                                        {{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}
                                    </span>
                                    <img src="{{ asset('assets/front/themes/theme-04/assets/images/comparar.png') }}"
                                        class="img-fluid icons-header" alt="Comparar">
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-sm-6 col-6 remove-padding">
                <div class="logo">
                    <a href="{{ route('front.index') }}">
                        <img src="{{ asset('storage/images/' . $gs->logo) }}" alt="">
                    </a>
                </div>
            </div>

            <div class="col-xl-4 col-lg-3 col-12">
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
                            <button type="submit"><i class="icofont-search-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- Logo Header Area End -->
</div>
<!--Main-Menu Area End-->
