<section class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-padding">
                <div class="content">
                    <div class="left-content">
                        <div class="list">
                            <ul>
                                @if(config("features.lang_switcher") && $gs->is_language == 1)
                                <li class="separador-right">
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

                                <!--PARTE DO LOGIN-->
                                @if(!Auth::guard('web')->check())

                                <li class="openperfil profilearea my-dropdown separador-right">
                                    <a href="javascript: ;" id="profile-icon" class="profile carticon">
                                        <span class="text">
                                            {{ __("Account") }}
                                            <i class="fas fa-caret-down"></i>
                                        </span>
                                    </a>
                                    <div class="my-dropdown-menu profile-dropdown">
                                        <ul class="profile-links">
                                            <li>
                                                <a href="{{ route('user.login') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Sign in") }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.login') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Join") }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>


                                @else
                                <li class="openperfil profilearea my-dropdown separador-right">
                                    <a href="javascript: ;" id="profile-icon" class="profile carticon">
                                        <span class="text">
                                            {{ __("Account") }}
                                            <i class="fas fa-caret-down"></i>
                                        </span>
                                    </a>
                                    <div class="my-dropdown-menu profile-dropdown">
                                        <ul class="profile-links">
                                            <li>
                                                <a href="{{ route('user-dashboard') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("User Panel") }}
                                                </a>
                                            </li>

                                            @if(config("features.marketplace"))
                                            @if(Auth::user()->IsVendor())
                                            <li>
                                                <a href="{{ route('vendor-dashboard') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Vendor Panel") }}
                                                </a>
                                            </li>
                                            @endif
                                            @endif

                                            <li>
                                                <a href="{{ route('user-profile') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Edit Profile") }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user-logout') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Logout") }}
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
                                            {{ __("Our Store") }}
                                            <i class="fas fa-caret-down"></i>
                                        </span>
                                    </a>
                                    <div class="my-dropdown-menu profile-dropdown">
                                        <ul class="profile-links">
                                            <li>
                                                <a href="{{ route('front.brands') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Brands") }}
                                                </a>
                                            </li>
                                            @if($gs->is_blog == 1)
                                            <li>
                                                <a href="{{ route('front.blog') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Blog") }}
                                                </a>
                                            </li>
                                            @endif

                                            @if($gs->is_faq == 1)
                                            <li>
                                                <a href="{{ route('front.faq') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Faq") }}
                                                </a>
                                            </li>
                                            @endif

                                            @if($gs->policy)
                                            <li>
                                                <a href="{{ route('front.policy') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Buy & Return Policy") }}
                                                </a>
                                            </li>
                                            @endif

                                            @foreach($pheader as $data)
                                            <li>
                                                <a href="{{ route('front.page',$data->slug) }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ $data->title }}
                                                </a>
                                            </li>
                                            @endforeach

                                            @if($gs->is_contact == 1)
                                            <li>
                                                <a href="{{ route('front.contact') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Contact Us") }}
                                                </a>
                                            </li>
                                            @endif

                                            @if($gs->is_cart)
                                            <li>
                                                <a href="javascript:;" data-toggle="modal"
                                                    data-target="#track-order-modal">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Track Order") }}
                                                </a>
                                            </li>
                                            @endif

                                            @if($gs->team_show_header == 1)
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
                                @if(config("features.currency_switcher") && $gs->is_currency == 1)
                                <li>
                                    <div class="currency-selector" style="padding-right:12px;">
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
                                <!--FINAL DA MOEDA-->
                                @if(config("features.productsListPdf"))
                                <li class="login ml-0 separador-left">
                                    <a target="_blank" href="{{ route('download-list-pdf') }}">
                                        <div class="links">
                                            {{ __("Products list - PDF") }}
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
                <div class="col-lg-4 col-sm-12 remove-padding">
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

                <div class="col-lg-4 col-sm-6 col-6 remove-padding">
                    <div class="logo">
                        <a href="{{ route('front.index') }}">
                            <img src="{{asset('storage/images/'.$gs->logo)}}" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 col-6 remove-padding">
                    <div class="helpful-links">
                        <ul class="helpful-links-inner">

                            @if($gs->is_cart)
                            <li class="my-dropdown">
                                <a href="javascript:;" class="cart carticon">
                                    <div class="icon">
                                        <svg class="icons-header" version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <g>
                                                <g>
                                                    <circle cx="181.333" cy="437.333" r="53.333" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M509.867,89.6c-2.133-2.133-4.267-4.267-8.533-4.267H96L85.333,29.867c-2.133-4.267-6.4-8.533-10.667-8.533h-64
                                                        C4.267,21.333,0,25.6,0,32s4.267,10.667,10.667,10.667h55.467l51.2,260.267c8.533,34.133,38.4,59.733,74.667,59.733h245.333
                                                        c6.4,0,10.667-4.267,10.667-10.667c0-6.4-4.267-10.667-10.667-10.667H192c-17.067,0-34.133-8.533-42.667-23.467L460.8,275.2
                                                        c4.267,0,8.533-4.267,8.533-8.533L512,96C512,96,512,91.733,509.867,89.6z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <circle cx="394.667" cy="437.333" r="53.333" />
                                                </g>
                                            </g>
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

                            <li class="wishlist" data-toggle="tooltip" data-placement="top" title="{{ __('Wish') }}">

                                @if(Auth::guard('web')->check())
                                <a href="{{ route('user-wishlists') }}" class="wish">
                                    <svg class="icons-header" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                        xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M376,30c-27.783,0-53.255,8.804-75.707,26.168c-21.525,16.647-35.856,37.85-44.293,53.268
                                                    c-8.437-15.419-22.768-36.621-44.293-53.268C189.255,38.804,163.783,30,136,30C58.468,30,0,93.417,0,177.514
                                                    c0,90.854,72.943,153.015,183.369,247.118c18.752,15.981,40.007,34.095,62.099,53.414C248.38,480.596,252.12,482,256,482
                                                    s7.62-1.404,10.532-3.953c22.094-19.322,43.348-37.435,62.111-53.425C439.057,330.529,512,268.368,512,177.514
                                                    C512,93.417,453.532,30,376,30z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                </a>
                                @else
                                <a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"
                                    class="wish">
                                    <svg class="icons-header" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                        xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M376,30c-27.783,0-53.255,8.804-75.707,26.168c-21.525,16.647-35.856,37.85-44.293,53.268
                                                    c-8.437-15.419-22.768-36.621-44.293-53.268C189.255,38.804,163.783,30,136,30C58.468,30,0,93.417,0,177.514
                                                    c0,90.854,72.943,153.015,183.369,247.118c18.752,15.981,40.007,34.095,62.099,53.414C248.38,480.596,252.12,482,256,482
                                                    s7.62-1.404,10.532-3.953c22.094-19.322,43.348-37.435,62.111-53.425C439.057,330.529,512,268.368,512,177.514
                                                    C512,93.417,453.532,30,376,30z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span id="wishlist-count">0</span>
                                </a>
                                @endif

                            </li>

                            <li class="compare" data-toggle="tooltip" data-placement="top" title="{{ __('Compare') }}">
                                <a href="{{ route('product.compare') }}" class="wish compare-product">
                                    <div class="icon">
                                        <svg class="icons-header" version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512.016 512.016"
                                            style="enable-background:new 0 0 512.016 512.016;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M496.008,79.997h-368v-48c0-6.464-3.904-12.32-9.888-14.784s-12.832-1.088-17.44,3.456l-96,96
                                                        c-6.24,6.24-6.24,16.384,0,22.624l96,96c4.608,4.576,11.456,5.952,17.44,3.488s9.888-8.32,9.888-14.784v-48h368
                                                        c8.832,0,16-7.168,16-16v-64C512.008,87.133,504.84,79.997,496.008,79.997z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M507.336,372.701l-96-96.032c-4.576-4.576-11.456-5.952-17.44-3.456c-5.984,2.496-9.888,8.32-9.888,14.784v48h-368
                                                        c-8.832,0-16,7.168-16,16v64c0,8.832,7.168,16,16,16h368v48c0,6.464,3.904,12.32,9.888,14.784
                                                        c5.984,2.496,12.864,1.12,17.44-3.456l96-96C513.576,389.085,513.576,378.941,507.336,372.701z" />
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
