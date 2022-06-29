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
                                            @if ($gs->is_brands == 1)
                                            <li>
                                                <a href="{{ route('front.brands') }}">
                                                    <i class="fas fa-caret-right"></i>
                                                    {{ __("Brands") }}
                                                </a>
                                            </li>
                                            @endif

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

                <div class="col-lg-3 col-sm-6 col-10 remove-padding">
                    <div class="logo">
                        <a href="{{ route('front.index') }}">
                            <img src="{{asset('storage/images/'.$gs->logo)}}" alt="">
                        </a>
                    </div>
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

                <div class="col-lg-3 col-sm-6 col-6 remove-padding">
                    <div class="helpful-links">
                        <ul class="helpful-links-inner">

                            @if($gs->is_cart)
                            <li class="my-dropdown">
                                <a href="javascript:;" class="cart carticon">
                                    <div class="icon">
                                        <svg class="img-fluid icons-header" version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512.001 512.001"
                                            style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M503.142,79.784c-7.303-8.857-18.128-13.933-29.696-13.933H176.37c-6.085,0-11.023,4.938-11.023,11.023
                                                c0,6.085,4.938,11.023,11.023,11.023h297.07c5.032,0,9.541,2.1,12.688,5.914c3.197,3.88,4.475,8.995,3.511,13.972l-44.054,220.282
                                                c-1.709,7.871-8.383,13.366-16.232,13.366H184.323L83.158,36.854C77.69,21.234,62.886,10.74,45.932,10.74
                                                c-0.005,0-0.011,0-0.017,0c-14.38,0.496-28.963,0.491-32.535,0.248c-3.555-0.772-7.397,0.22-10.152,2.976
                                                c-4.305,4.305-4.305,11.282,0,15.587c3.412,3.412,4.564,4.564,43.068,3.23c7.22,0,13.674,4.564,15.995,11.188l103.618,311.962
                                                c1.499,4.503,5.71,7.545,10.461,7.545h252.982c18.31,0,33.841-12.638,37.815-30.909l44.109-220.525
                                                C513.503,100.513,510.544,88.757,503.142,79.784z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M424.392,424.11H223.77c-6.785,0-13.162-4.674-15.46-11.233l-21.495-63.935c-1.94-5.771-8.207-8.885-13.961-6.934
                                                c-5.771,1.935-8.874,8.19-6.934,13.961l21.539,64.061c5.473,15.625,20.062,26.119,36.31,26.119h200.622
                                                c6.085,0,11.023-4.933,11.023-11.018S430.477,424.11,424.392,424.11z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M231.486,424.104c-21.275,0-38.581,17.312-38.581,38.581s17.306,38.581,38.581,38.581s38.581-17.312,38.581-38.581
                                                S252.761,424.104,231.486,424.104z M231.486,479.22c-9.116,0-16.535-7.419-16.535-16.535c0-9.116,7.419-16.535,16.535-16.535
                                                c9.116,0,16.535,7.419,16.535,16.535C248.021,471.802,240.602,479.22,231.486,479.22z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M424.392,424.104c-21.269,0-38.581,17.312-38.581,38.581s17.312,38.581,38.581,38.581
                                                c21.269,0,38.581-17.312,38.581-38.581S445.661,424.104,424.392,424.104z M424.392,479.22c-9.116,0-16.535-7.419-16.535-16.535
                                                c0-9.116,7.419-16.535,16.535-16.535c9.116,0,16.535,7.419,16.535,16.535C440.927,471.802,433.508,479.22,424.392,479.22z" />
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
                                    <svg class="img-fluid icons-header" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 448.45 448.45"
                                        style="enable-background:new 0 0 448.45 448.45;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M446.285,250.825c-5.322-24.01-21.278-44.294-43.36-55.12v0c-6.892-3.388-14.3-5.605-21.92-6.56
                                                    c1.36-3.84,2.56-8,3.6-11.52c7.714-31.008,0.882-63.842-18.56-89.2c-20.05-27.267-51.457-43.884-85.28-45.12
                                                    c-36.314-1.332-70.143,18.386-86.88,50.64c-16.765-32.267-50.623-51.983-86.96-50.64c-33.795,1.26-65.167,17.874-85.2,45.12
                                                    c-19.47,25.345-26.331,58.179-18.64,89.2c12.72,48.8,50.16,83.52,89.84,120c12.4,11.52,25.28,23.44,37.28,35.84
                                                    c32,33.36,57.44,61.12,57.68,61.36c2.972,3.27,8.031,3.511,11.301,0.539c0.188-0.171,0.368-0.351,0.539-0.539
                                                    c0,0,10.8-12,27.12-29.36c7.12,20,11.76,34.08,11.84,34.24c1.379,4.198,5.9,6.482,10.097,5.104
                                                    c0.266-0.087,0.527-0.189,0.783-0.304c0,0,24-10.88,54.88-23.28c11.28-4.56,22.96-8.56,34.32-12.48
                                                    c36.64-12.24,71.2-24.32,93.52-52.72C446.647,297.562,451.802,273.556,446.285,250.825z M193.886,377.945
                                                    c-9.36-10.24-28.88-31.28-52.16-55.28c-12.32-12.64-25.28-24.72-37.84-36.4c-37.92-35.2-73.76-68.4-85.28-112.64
                                                    c-6.475-26.347-0.585-54.208,16-75.68c17.164-23.31,44.031-37.51,72.96-38.56c58.8-2.32,78,53.44,78.72,56
                                                    c1.38,4.197,5.901,6.482,10.098,5.102c2.415-0.794,4.308-2.687,5.102-5.102c0-0.56,19.44-57.92,78.72-56
                                                    c28.929,1.05,55.796,15.25,72.96,38.56c16.585,21.472,22.475,49.333,16,75.68c-1.423,5.448-3.214,10.794-5.36,16
                                                    c-10.968,1.564-21.456,5.525-30.72,11.6c-3.21-24.908-19.692-46.108-43.04-55.36c-22.909-9.147-48.738-7.35-70.16,4.88
                                                    c-20.526,11.219-34.812,31.19-38.8,54.24c-5.84,35.92,8.64,69.52,24,105.12c4.72,11.04,9.68,22.4,13.84,33.76l1.92,5.12
                                                    C209.086,361.385,199.566,371.705,193.886,377.945z M420.126,306.105l0-0.16c-19.84,25.04-51.84,36.24-86.56,48.08
                                                    c-11.52,4-23.44,8-35.12,12.8c-20.24,8-37.68,16-47.36,19.92c-3.36-10-9.6-28-17.2-48.4c-4.4-11.76-9.36-23.36-14.16-34.56
                                                    c-14.4-33.36-27.92-64.88-22.88-96c3.219-18.253,14.589-34.041,30.88-42.88c9.757-5.547,20.776-8.495,32-8.56
                                                    c8.222,0.01,16.367,1.585,24,4.64c37.2,14.88,33.76,54.64,33.6,56c-0.457,4.395,2.736,8.327,7.131,8.784
                                                    c2.553,0.265,5.078-0.711,6.789-2.624c1.12-1.28,28.24-30.64,64-13.12c17.829,8.655,30.732,24.975,35.04,44.32
                                                    C434.949,272.245,431.21,291.295,420.126,306.105z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                </a>
                                @else
                                <a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"
                                    class="wish">
                                    <svg class="img-fluid icons-header" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 448.45 448.45"
                                        style="enable-background:new 0 0 448.45 448.45;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M446.285,250.825c-5.322-24.01-21.278-44.294-43.36-55.12v0c-6.892-3.388-14.3-5.605-21.92-6.56
                                                    c1.36-3.84,2.56-8,3.6-11.52c7.714-31.008,0.882-63.842-18.56-89.2c-20.05-27.267-51.457-43.884-85.28-45.12
                                                    c-36.314-1.332-70.143,18.386-86.88,50.64c-16.765-32.267-50.623-51.983-86.96-50.64c-33.795,1.26-65.167,17.874-85.2,45.12
                                                    c-19.47,25.345-26.331,58.179-18.64,89.2c12.72,48.8,50.16,83.52,89.84,120c12.4,11.52,25.28,23.44,37.28,35.84
                                                    c32,33.36,57.44,61.12,57.68,61.36c2.972,3.27,8.031,3.511,11.301,0.539c0.188-0.171,0.368-0.351,0.539-0.539
                                                    c0,0,10.8-12,27.12-29.36c7.12,20,11.76,34.08,11.84,34.24c1.379,4.198,5.9,6.482,10.097,5.104
                                                    c0.266-0.087,0.527-0.189,0.783-0.304c0,0,24-10.88,54.88-23.28c11.28-4.56,22.96-8.56,34.32-12.48
                                                    c36.64-12.24,71.2-24.32,93.52-52.72C446.647,297.562,451.802,273.556,446.285,250.825z M193.886,377.945
                                                    c-9.36-10.24-28.88-31.28-52.16-55.28c-12.32-12.64-25.28-24.72-37.84-36.4c-37.92-35.2-73.76-68.4-85.28-112.64
                                                    c-6.475-26.347-0.585-54.208,16-75.68c17.164-23.31,44.031-37.51,72.96-38.56c58.8-2.32,78,53.44,78.72,56
                                                    c1.38,4.197,5.901,6.482,10.098,5.102c2.415-0.794,4.308-2.687,5.102-5.102c0-0.56,19.44-57.92,78.72-56
                                                    c28.929,1.05,55.796,15.25,72.96,38.56c16.585,21.472,22.475,49.333,16,75.68c-1.423,5.448-3.214,10.794-5.36,16
                                                    c-10.968,1.564-21.456,5.525-30.72,11.6c-3.21-24.908-19.692-46.108-43.04-55.36c-22.909-9.147-48.738-7.35-70.16,4.88
                                                    c-20.526,11.219-34.812,31.19-38.8,54.24c-5.84,35.92,8.64,69.52,24,105.12c4.72,11.04,9.68,22.4,13.84,33.76l1.92,5.12
                                                    C209.086,361.385,199.566,371.705,193.886,377.945z M420.126,306.105l0-0.16c-19.84,25.04-51.84,36.24-86.56,48.08
                                                    c-11.52,4-23.44,8-35.12,12.8c-20.24,8-37.68,16-47.36,19.92c-3.36-10-9.6-28-17.2-48.4c-4.4-11.76-9.36-23.36-14.16-34.56
                                                    c-14.4-33.36-27.92-64.88-22.88-96c3.219-18.253,14.589-34.041,30.88-42.88c9.757-5.547,20.776-8.495,32-8.56
                                                    c8.222,0.01,16.367,1.585,24,4.64c37.2,14.88,33.76,54.64,33.6,56c-0.457,4.395,2.736,8.327,7.131,8.784
                                                    c2.553,0.265,5.078-0.711,6.789-2.624c1.12-1.28,28.24-30.64,64-13.12c17.829,8.655,30.732,24.975,35.04,44.32
                                                    C434.949,272.245,431.21,291.295,420.126,306.105z" />
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
                                        <svg class="img-fluid icons-header" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M508.479,162.74l-106.667-96c-4.354-3.938-11.104-3.594-15.083,0.792c-3.938,4.375-3.583,11.125,0.792,15.063
                                                        L473.542,160H181.333c-5.896,0-10.667,4.771-10.667,10.667s4.771,10.667,10.667,10.667h292.208l-86.021,77.406
                                                        c-4.375,3.938-4.729,10.688-0.792,15.063c2.125,2.344,5.021,3.531,7.938,3.531c2.542,0,5.104-0.906,7.146-2.74l106.667-96
                                                        c2.229-2.021,3.521-4.906,3.521-7.927C512,167.646,510.708,164.761,508.479,162.74z" />
                                                        <path d="M330.667,330.667H38.458l86.021-77.406c4.375-3.938,4.729-10.688,0.792-15.063c-3.979-4.385-10.708-4.729-15.083-0.792
                                                        l-106.667,96C1.292,335.427,0,338.313,0,341.333s1.292,5.906,3.521,7.927l106.667,96c2.042,1.833,4.604,2.74,7.146,2.74
                                                        c2.917,0,5.813-1.188,7.938-3.531c3.938-4.375,3.583-11.125-0.792-15.063L38.458,352h292.208c5.896,0,10.667-4.771,10.667-10.667
                                                        S336.563,330.667,330.667,330.667z" />
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
