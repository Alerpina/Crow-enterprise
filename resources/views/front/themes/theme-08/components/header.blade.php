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
                                        <svg class="img-fluid icons-header" xmlns="http://www.w3.org/2000/svg"
                                            width="29" height="29" viewBox="0 0 38.754 33.401">
                                            <g transform="translate(-43.182 -107.782)">
                                                <path
                                                    d="M80.3,129.83q-.849,2.194-1.694,4.384-1.351,3.5-2.7,6.987c-.207.533-.413,1.07-.62,1.6.264-.2.533-.4.8-.607h-16.9c-.777,0-1.562-.033-2.343,0h-.033c.264.2.533.4.8.607-.2-.6-.4-1.207-.6-1.814q-.719-2.175-1.434-4.351-.862-2.622-1.727-5.244-.75-2.275-1.5-4.549c-.244-.735-.467-1.475-.727-2.206,0-.012-.008-.021-.012-.033a.853.853,0,0,0-.8-.607H44.009a.826.826,0,1,0,0,1.653h6.806c-.264-.2-.533-.4-.8-.607.2.6.4,1.207.6,1.814q.719,2.176,1.434,4.351.862,2.622,1.727,5.244.75,2.275,1.5,4.549c.244.736.467,1.475.727,2.207,0,.012.008.021.012.033a.853.853,0,0,0,.8.607h16.9c.777,0,1.562.029,2.343,0h.033a.859.859,0,0,0,.8-.607q.849-2.194,1.694-4.384,1.351-3.5,2.7-6.987c.207-.533.413-1.07.62-1.6a.829.829,0,0,0-.578-1.016.848.848,0,0,0-1.017.578Z"
                                                    transform="translate(0 -15.548)" />
                                                <path
                                                    d="M299.72,275.406q-1,1.791-2.012,3.578c-.1.174-.194.343-.289.517a.834.834,0,0,0,.715,1.244h18.925c.872,0,1.748.021,2.624,0h.037a.826.826,0,1,0,0-1.653H300.794c-.872,0-1.752-.037-2.624,0h-.037c.24.413.475.831.715,1.244q1-1.791,2.012-3.578c.1-.174.194-.343.289-.517a.828.828,0,1,0-1.43-.835Zm12.512,10.483a3.7,3.7,0,0,0,2.43,3.43,3.643,3.643,0,0,0,3.971-1.058,3.64,3.64,0,1,0-6.4-2.372.826.826,0,1,0,1.653,0c0-.066,0-.136.008-.2a.614.614,0,0,1,.008-.087c.012-.165,0,.054-.008.05a1.6,1.6,0,0,1,.1-.4c.012-.033.037-.174.066-.182.008,0-.074.153-.029.07a1.047,1.047,0,0,0,.045-.1,3.76,3.76,0,0,1,.211-.351c.079-.12-.112.128.021-.025.041-.045.083-.1.128-.141s.091-.091.136-.132c.021-.017.041-.037.062-.054s.149-.083.041-.037c-.091.037-.025.021,0,0s.058-.041.091-.062a1.568,1.568,0,0,1,.14-.083c.062-.037.128-.066.194-.1.021-.012.107-.054,0,0-.124.058.041-.012.054-.017a2.556,2.556,0,0,1,.347-.1c.037-.008.074-.012.112-.021.091-.021-.079.008-.079.008.074,0,.153-.017.227-.017a3.313,3.313,0,0,1,.4.012c.153.012-.157-.029.033.008.074.012.145.033.219.05s.124.037.186.058a.959.959,0,0,1,.1.037c0,.012-.153-.078-.07-.029.116.07.244.124.359.2.029.021.058.041.091.062s.091.037,0,0-.029-.025,0,0l.083.07a3.7,3.7,0,0,1,.281.289c.124.136-.058-.1.021.025.033.054.07.1.1.157s.066.112.1.165l.037.074c.078.149.017-.012,0-.021.05.017.1.314.12.368s.025.112.037.165c.033.157,0-.05,0-.054.021.021.012.116.012.141a2.853,2.853,0,0,1,0,.376,1.018,1.018,0,0,0-.008.116c0,.083-.05.07.008-.05a1.285,1.285,0,0,0-.045.219c-.029.116-.074.227-.107.343s.074-.141.021-.045a.4.4,0,0,0-.033.074c-.033.066-.066.128-.1.19s-.066.107-.1.161c-.112.169.078-.083-.017.029a3.144,3.144,0,0,1-.281.293c-.017.016-.116.124-.145.124,0,0,.169-.116.037-.033-.025.017-.045.029-.066.045-.116.074-.236.136-.355.2s.149-.05-.029.012l-.182.062-.19.05c-.029,0-.054.012-.083.017-.182.041.132-.008.025,0a3.334,3.334,0,0,1-.4.017c-.066,0-.132-.008-.2-.012-.025,0-.124-.012,0,0,.136.012-.029-.008-.058-.012a3.132,3.132,0,0,1-.426-.124c-.025-.008-.107-.05,0,0,.12.058-.025-.012-.05-.025-.066-.033-.128-.066-.19-.1s-.12-.079-.182-.12c-.1-.062.012.033.037.033-.017,0-.07-.058-.083-.07a3.05,3.05,0,0,1-.306-.306.488.488,0,0,1-.07-.083c0,.017.1.14.033.037-.041-.062-.083-.12-.12-.182s-.078-.145-.116-.215c-.087-.169.041.132-.025-.054a3.009,3.009,0,0,1-.12-.43.267.267,0,0,0-.017-.083c.062.136.012.116,0,.021s-.012-.174-.012-.26a.837.837,0,0,0-1.673,0Zm-14.243,0a3.7,3.7,0,0,0,2.43,3.43,3.643,3.643,0,0,0,3.971-1.058,3.64,3.64,0,1,0-6.4-2.372.826.826,0,1,0,1.653,0c0-.066,0-.136.008-.2a.619.619,0,0,1,.008-.087c.012-.165,0,.054-.008.05a1.606,1.606,0,0,1,.1-.4c.012-.033.037-.174.066-.182.008,0-.074.153-.029.07a1.071,1.071,0,0,0,.045-.1,3.747,3.747,0,0,1,.211-.351c.079-.12-.112.128.021-.025.041-.045.083-.1.128-.141s.091-.091.136-.132c.021-.017.041-.037.062-.054s.149-.083.041-.037c-.091.037-.025.021,0,0s.058-.041.091-.062a1.551,1.551,0,0,1,.141-.083c.062-.037.128-.066.194-.1.021-.012.107-.054,0,0-.124.058.041-.012.054-.017a2.558,2.558,0,0,1,.347-.1c.037-.008.074-.012.112-.021.091-.021-.078.008-.078.008.074,0,.153-.017.227-.017a3.312,3.312,0,0,1,.4.012c.153.012-.157-.029.033.008.074.012.145.033.219.05s.124.037.186.058a.955.955,0,0,1,.1.037c0,.012-.153-.078-.07-.029.116.07.244.124.359.2.029.021.058.041.091.062s.091.037,0,0-.029-.025,0,0l.083.07a3.686,3.686,0,0,1,.281.289c.124.136-.058-.1.021.025.033.054.07.1.1.157s.066.112.1.165l.037.074c.078.149.017-.012,0-.021.05.017.1.314.12.368s.025.112.037.165c.033.157,0-.05,0-.054.021.021.012.116.012.141a2.853,2.853,0,0,1,0,.376,1.011,1.011,0,0,0-.008.116c0,.083-.05.07.008-.05a1.29,1.29,0,0,0-.045.219c-.029.116-.074.227-.107.343s.074-.141.021-.045a.406.406,0,0,0-.033.074c-.033.066-.066.128-.1.19s-.066.107-.1.161c-.112.169.079-.083-.017.029a3.144,3.144,0,0,1-.281.293c-.017.016-.116.124-.145.124,0,0,.169-.116.037-.033-.025.017-.045.029-.066.045-.116.074-.236.136-.355.2s.149-.05-.029.012l-.182.062-.19.05c-.029,0-.054.012-.083.017-.182.041.132-.008.025,0a3.334,3.334,0,0,1-.4.017c-.066,0-.132-.008-.2-.012-.025,0-.124-.012,0,0,.136.012-.029-.008-.058-.012a3.133,3.133,0,0,1-.426-.124c-.025-.008-.107-.05,0,0,.12.058-.025-.012-.05-.025-.066-.033-.128-.066-.19-.1s-.12-.079-.182-.12c-.1-.062.012.033.037.033-.017,0-.07-.058-.083-.07a3.044,3.044,0,0,1-.306-.306.488.488,0,0,1-.07-.083c0,.017.1.14.033.037-.041-.062-.083-.12-.12-.182s-.078-.145-.116-.215c-.087-.169.041.132-.025-.054a3.013,3.013,0,0,1-.12-.43.266.266,0,0,0-.017-.083c.062.136.012.116,0,.021s-.012-.174-.012-.26a.837.837,0,0,0-1.673,0Zm6.516-21.958,4.2,4.2.591.591a.84.84,0,0,0,1.169,0l4.2-4.2.591-.591a.827.827,0,0,0-1.169-1.169l-4.2,4.2-.591.591h1.169l-4.2-4.2-.591-.591a.827.827,0,0,0-1.169,1.169Z"
                                                    transform="translate(-243.628 -148.347)" />
                                                <path
                                                    d="M583.053,119.786V108.609a.826.826,0,0,0-1.653,0v11.177a.826.826,0,1,0,1.653,0Z"
                                                    transform="translate(-515.979 0)" />
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
                                    <svg class="img-fluid icons-header" xmlns="http://www.w3.org/2000/svg" width="29"
                                        height="29" viewBox="0 0 35 31.167">
                                        <g transform="translate(-3.999 -1025.989)">
                                            <path
                                                d="M29.2,5.627a9.758,9.758,0,0,0-6.932,2.885l-.766.769-.766-.769a9.774,9.774,0,0,0-13.862,0,9.85,9.85,0,0,0,0,13.9L8.156,23.7,20.984,36.58a.729.729,0,0,0,1.031,0L34.843,23.7l1.285-1.287a9.85,9.85,0,0,0,0-13.9A9.751,9.751,0,0,0,29.2,5.627ZM13.8,7.074a8.3,8.3,0,0,1,5.9,2.469l1.285,1.287a.729.729,0,0,0,1.031,0L23.3,9.543a8.281,8.281,0,0,1,11.794,0,8.365,8.365,0,0,1,0,11.845l-1.282,1.287L21.5,35.034,9.187,22.676,7.905,21.388A8.392,8.392,0,0,1,13.8,7.074Zm.04,1.472a6.927,6.927,0,0,0-6,10.39.729.729,0,1,0,1.262-.729A5.468,5.468,0,0,1,13.843,10a.729.729,0,1,0,0-1.458Z"
                                                transform="translate(0 1020.362)" fill-rule="evenodd" />
                                        </g>
                                    </svg>
                                    <span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
                                </a>
                                @else
                                <a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"
                                    class="wish">
                                    <svg class="img-fluid icons-header" xmlns="http://www.w3.org/2000/svg" width="29"
                                        height="29" viewBox="0 0 35 31.167">
                                        <g transform="translate(-3.999 -1025.989)">
                                            <path
                                                d="M29.2,5.627a9.758,9.758,0,0,0-6.932,2.885l-.766.769-.766-.769a9.774,9.774,0,0,0-13.862,0,9.85,9.85,0,0,0,0,13.9L8.156,23.7,20.984,36.58a.729.729,0,0,0,1.031,0L34.843,23.7l1.285-1.287a9.85,9.85,0,0,0,0-13.9A9.751,9.751,0,0,0,29.2,5.627ZM13.8,7.074a8.3,8.3,0,0,1,5.9,2.469l1.285,1.287a.729.729,0,0,0,1.031,0L23.3,9.543a8.281,8.281,0,0,1,11.794,0,8.365,8.365,0,0,1,0,11.845l-1.282,1.287L21.5,35.034,9.187,22.676,7.905,21.388A8.392,8.392,0,0,1,13.8,7.074Zm.04,1.472a6.927,6.927,0,0,0-6,10.39.729.729,0,1,0,1.262-.729A5.468,5.468,0,0,1,13.843,10a.729.729,0,1,0,0-1.458Z"
                                                transform="translate(0 1020.362)" fill-rule="evenodd" />
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
