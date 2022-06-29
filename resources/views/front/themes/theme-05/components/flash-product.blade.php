@php
if ($gs->switch_highlight_currency) {
$highlight = $prod->firstCurrencyPrice();
$small = $prod->showPrice();
} else {
$highlight = $prod->showPrice();
$small = $prod->firstCurrencyPrice();
}
@endphp

{{-- If This product belongs to vendor then apply this --}}
@if($prod->user_id != 0)
{{-- check If This vendor status is active --}}
@if($prod->user->is_vendor == 2)
<div class="card-product-flash">
    <a href="{{ route('front.product', $prod->slug) }}" class="item">
        @if(!is_null($prod->discount_percent))
        <span class="badge badge-danger descont-card">
            {{ $prod->discount_percent."%"}} &nbsp;
            <span style="font-weight: lighter">
                {{ "OFF" }}
            </span>
        </span>
        @endif
        <div class="info">
            <h4 class="price">{{ $highlight }} @if($curr->id != $scurrency->id)<br><small>{{ $small }}</small>@endif
            </h4>
            <h5 class="name">{{ $prod->showName() }}</h5>

        </div>


        <div class="item-img {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0 ? "
            baw":"" }}">
            @if($admstore->reference_code == 1)
            @php $prod = App\Models\Product::findOrFail($prod->id); @endphp
            <div class="sell-area ref">
                <span class="sale">{{$prod->ref_code}}</span>
            </div>
            @endif
            @if(!empty($prod->features))
            <div class="sell-area">
                @foreach($prod->features as $key => $data1)
                <span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
                @endforeach
            </div>
            @endif
            <div class="extra-list">
                <ul>
                    <li>
                        @if(Auth::guard('web')->check())
                        <span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                            data-toggle="tooltip" data-placement="right" title="{{ __('Add To Wishlist') }}"
                            data-placement="right">
                            <svg class="icons-header" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M378.667,21.333c-56.792,0-103.698,52.75-122.667,77.646c-18.969-24.896-65.875-77.646-122.667-77.646
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
                        </span>
                        @else
                        <span rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal" id="wish-btn"
                            data-target="#comment-log-reg" data-placement="right">
                            <svg class="icons-header" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M378.667,21.333c-56.792,0-103.698,52.75-122.667,77.646c-18.969-24.896-65.875-77.646-122.667-77.646
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
                        </span>
                        @endif
                    </li>
                    <li>
                        <span class="quick-view" rel-toggle="tooltip" title="{{ __('Quick View') }}" href="javascript:;"
                            data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal"
                            data-target="#quickview" data-placement="right">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M510.484,251.474C447.574,168.069,354.819,120.235,256,120.235S64.425,168.07,1.515,251.474
																				c-2.02,2.679-2.02,6.371,0,9.051C64.425,343.93,157.181,391.765,256,391.765s191.574-47.834,254.484-131.239
																				C512.505,257.846,512.505,254.153,510.484,251.474z M256,376.736c-92.263,0-179.064-43.928-239.014-120.736
																				C76.936,179.192,163.737,135.264,256,135.264c92.262,0,179.063,43.928,239.014,120.736
																				C435.063,332.808,348.262,376.736,256,376.736z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M345.357,176.3c-2.763-3.096-7.514-3.367-10.611-0.603c-3.096,2.764-3.366,7.515-0.603,10.611
																				c17.128,19.19,26.562,43.942,26.562,69.692c0,57.734-46.971,104.704-104.705,104.704c-57.735,0-104.705-46.971-104.705-104.704
																				S198.265,151.295,256,151.295c16.904,0,33.036,3.902,47.945,11.596c3.686,1.901,8.22,0.456,10.124-3.232
																				c1.903-3.688,0.456-8.221-3.232-10.124c-16.821-8.681-35.783-13.269-54.836-13.269c-66.022,0-119.734,53.712-119.734,119.734
																				S189.978,375.734,256,375.734S375.734,322.021,375.734,256C375.734,226.552,364.945,198.248,345.357,176.3z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M256,208.407c-26.242,0-47.593,21.35-47.593,47.593c0,26.242,21.351,47.593,47.593,47.593s47.593-21.351,47.593-47.593
																				S282.242,208.407,256,208.407z M256,288.563c-17.955,0-32.564-14.608-32.564-32.564s14.609-32.564,32.564-32.564
																				c17.956,0,32.564,14.608,32.564,32.564S273.956,288.563,256,288.563z" />
                                    </g>
                                </g>
                            </svg>
                        </span>
                    </li>
                    <li>
                        <span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"
                            data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                            data-placement="right">
                            <svg class="icons-header" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 368.008 368.008"
                                style="enable-background:new 0 0 368.008 368.008;" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M39.316,207.968c0.232,0.024,0.464,0.032,0.696,0.032c3.848,0,7.2-2.776,7.872-6.64
																					c0.464-2.664,12.064-65.352,72.12-65.352h112v32c0,3.168,1.864,6.032,4.768,7.32c2.896,1.28,6.272,0.736,8.616-1.4l88-80
																					c1.664-1.52,2.616-3.664,2.616-5.92s-0.952-4.4-2.616-5.92l-88-80c-2.344-2.136-5.728-2.688-8.616-1.4
																					c-2.904,1.288-4.768,4.152-4.768,7.32v40h-112c-47.696,0-88,36.64-88,80v72C32.004,204.16,35.18,207.616,39.316,207.968z
																					M48.004,128.008c0-34.688,32.976-64,72-64h120c4.424,0,8-3.584,8-8V26.096l68.112,61.912l-68.112,61.912v-21.912
																					c0-4.416-3.576-8-8-8h-120c-37.304,0-59.328,19.968-72,39.784V128.008z" />
                                            <path d="M328.692,160.048c-4.12-0.392-7.856,2.504-8.568,6.608c-0.472,2.664-12.064,65.352-72.12,65.352h-104v-32
																					c0-3.104-1.8-5.928-4.608-7.248c-2.816-1.312-6.128-0.888-8.512,1.104l-96,80c-1.824,1.52-2.88,3.768-2.88,6.144
																					c0,2.376,1.056,4.624,2.88,6.144l96,80c1.464,1.224,3.288,1.856,5.12,1.856c1.152,0,2.312-0.248,3.392-0.752
																					c2.808-1.32,4.608-4.144,4.608-7.248v-40h104c47.704,0,88-36.64,88-80v-72C336.004,163.856,332.828,160.4,328.692,160.048z
																					M320.004,240.008c0,34.688-32.968,64-72,64h-112c-4.416,0-8,3.584-8,8v30.92L52.5,280.008l75.504-62.92v22.92
																					c0,4.416,3.584,8,8,8h112c37.304,0,59.328-19.968,72-39.784V240.008z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                    </li>
                </ul>
            </div>
            <img class="img-fluid" src="{{filter_var($prod->thumbnail, FILTER_VALIDATE_URL) ? $prod->thumbnail :
													asset('storage/images/thumbnails/'.$prod->thumbnail)}}" alt="">
            @if($gs->is_rating == 1)
            <div class="stars">
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                </div>
            </div>
            @endif
        </div>

        @if($gs->is_cart)
        <div class="item-cart-area">
            @if($prod->product_type == "affiliate")
            <span class="add-to-cart-btn affilate-btn" data-href="{{ route('affiliate.product', $prod->slug) }}">
                {{ __("Buy Now") }}
            </span>
            @else
            @if($prod->emptyStock())
            <span class="add-to-cart-btn cart-out-of-stock">
                <i class="icofont-close-circled"></i> {{ __("Out of Stock!") }}
            </span>
            @else
            @if($gs->is_cart_and_buy_available)
            <span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
                {{ __("Add To Cart") }}
            </span>
            <span class="add-to-cart-quick add-to-cart-btn" data-href="{{ route('product.cart.quickadd',$prod->id) }}">
                {{ __("Buy Now") }}
            </span>
            @else
            <span class="add-to-cart-btn" href="{{ route('front.product', $prod->slug)}}">
                {{ __("Details") }}
            </span>
            @endif
            @endif
            @endif
        </div>
        @else
        <span class="add-to-cart-btn" href="{{ route('front.product', $prod->slug)}}">
            {{ __("Details") }}
        </span>
        @endif

    </a>
    <div class="deal-counter">
        <div data-countdown="{{ $prod->discount_date }}"></div>
    </div>
</div>

@endif
{{-- If This product belongs admin and apply this --}}
@else

<div class="card-product-flash">
    <a href="{{ route('front.product', $prod->slug) }}" class="item">
        @if(!is_null($prod->discount_percent))
        <span class="badge badge-danger descont-card">
            {{ $prod->discount_percent."%"}} &nbsp;
            <span style="font-weight: lighter">
                {{ "OFF" }}
            </span>
        </span>
        @endif
        <div class="info">

            <h4 class="price">{{ $highlight }} @if($curr->id != $scurrency->id)<br><small>{{ $small }}</small> @endif
            </h4>
            <h5 class="name">{{ $prod->showName() }}</h5>

        </div>

        <div class="item-img {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0 ? "
            baw":"" }}">
            @if($admstore->reference_code == 1)
            @php $prod = App\Models\Product::findOrFail($prod->id); @endphp
            <div class="sell-area ref">
                <span class="sale">{{$prod->ref_code}}</span>
            </div>
            @endif
            @if(!empty($prod->features))
            <div class="sell-area">
                @foreach($prod->features as $key => $data1)
                <span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
                @endforeach
            </div>
            @endif
            <div class="extra-list">
                <ul>
                    <li>
                        @if(Auth::guard('web')->check())
                        <span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}"
                            data-toggle="tooltip" data-placement="right" title="{{ __('Add To Wishlist') }}"
                            data-placement="right">
                            <svg class="icons-header" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M378.667,21.333c-56.792,0-103.698,52.75-122.667,77.646c-18.969-24.896-65.875-77.646-122.667-77.646
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
                        </span>
                        @else
                        <span rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal" id="wish-btn"
                            data-target="#comment-log-reg" data-placement="right">
                            <svg class="icons-header" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M378.667,21.333c-56.792,0-103.698,52.75-122.667,77.646c-18.969-24.896-65.875-77.646-122.667-77.646
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
                        </span>
                        @endif
                    </li>
                    <li>
                        <span class="quick-view" rel-toggle="tooltip" title="{{ __('Quick View') }}" href="javascript:;"
                            data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal"
                            data-target="#quickview" data-placement="right">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M510.484,251.474C447.574,168.069,354.819,120.235,256,120.235S64.425,168.07,1.515,251.474
																				c-2.02,2.679-2.02,6.371,0,9.051C64.425,343.93,157.181,391.765,256,391.765s191.574-47.834,254.484-131.239
																				C512.505,257.846,512.505,254.153,510.484,251.474z M256,376.736c-92.263,0-179.064-43.928-239.014-120.736
																				C76.936,179.192,163.737,135.264,256,135.264c92.262,0,179.063,43.928,239.014,120.736
																				C435.063,332.808,348.262,376.736,256,376.736z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M345.357,176.3c-2.763-3.096-7.514-3.367-10.611-0.603c-3.096,2.764-3.366,7.515-0.603,10.611
																				c17.128,19.19,26.562,43.942,26.562,69.692c0,57.734-46.971,104.704-104.705,104.704c-57.735,0-104.705-46.971-104.705-104.704
																				S198.265,151.295,256,151.295c16.904,0,33.036,3.902,47.945,11.596c3.686,1.901,8.22,0.456,10.124-3.232
																				c1.903-3.688,0.456-8.221-3.232-10.124c-16.821-8.681-35.783-13.269-54.836-13.269c-66.022,0-119.734,53.712-119.734,119.734
																				S189.978,375.734,256,375.734S375.734,322.021,375.734,256C375.734,226.552,364.945,198.248,345.357,176.3z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M256,208.407c-26.242,0-47.593,21.35-47.593,47.593c0,26.242,21.351,47.593,47.593,47.593s47.593-21.351,47.593-47.593
																				S282.242,208.407,256,208.407z M256,288.563c-17.955,0-32.564-14.608-32.564-32.564s14.609-32.564,32.564-32.564
																				c17.956,0,32.564,14.608,32.564,32.564S273.956,288.563,256,288.563z" />
                                    </g>
                                </g>
                            </svg>
                        </span>
                    </li>
                    <li>
                        <span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"
                            data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                            data-placement="right">
                            <svg class="icons-header" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 368.008 368.008"
                                style="enable-background:new 0 0 368.008 368.008;" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M39.316,207.968c0.232,0.024,0.464,0.032,0.696,0.032c3.848,0,7.2-2.776,7.872-6.64
																					c0.464-2.664,12.064-65.352,72.12-65.352h112v32c0,3.168,1.864,6.032,4.768,7.32c2.896,1.28,6.272,0.736,8.616-1.4l88-80
																					c1.664-1.52,2.616-3.664,2.616-5.92s-0.952-4.4-2.616-5.92l-88-80c-2.344-2.136-5.728-2.688-8.616-1.4
																					c-2.904,1.288-4.768,4.152-4.768,7.32v40h-112c-47.696,0-88,36.64-88,80v72C32.004,204.16,35.18,207.616,39.316,207.968z
																					M48.004,128.008c0-34.688,32.976-64,72-64h120c4.424,0,8-3.584,8-8V26.096l68.112,61.912l-68.112,61.912v-21.912
																					c0-4.416-3.576-8-8-8h-120c-37.304,0-59.328,19.968-72,39.784V128.008z" />
                                            <path d="M328.692,160.048c-4.12-0.392-7.856,2.504-8.568,6.608c-0.472,2.664-12.064,65.352-72.12,65.352h-104v-32
																					c0-3.104-1.8-5.928-4.608-7.248c-2.816-1.312-6.128-0.888-8.512,1.104l-96,80c-1.824,1.52-2.88,3.768-2.88,6.144
																					c0,2.376,1.056,4.624,2.88,6.144l96,80c1.464,1.224,3.288,1.856,5.12,1.856c1.152,0,2.312-0.248,3.392-0.752
																					c2.808-1.32,4.608-4.144,4.608-7.248v-40h104c47.704,0,88-36.64,88-80v-72C336.004,163.856,332.828,160.4,328.692,160.048z
																					M320.004,240.008c0,34.688-32.968,64-72,64h-112c-4.416,0-8,3.584-8,8v30.92L52.5,280.008l75.504-62.92v22.92
																					c0,4.416,3.584,8,8,8h112c37.304,0,59.328-19.968,72-39.784V240.008z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                    </li>
                </ul>
            </div>
            <img class="img-fluid" src="{{filter_var($prod->thumbnail, FILTER_VALIDATE_URL) ? $prod->thumbnail :
													asset('storage/images/thumbnails/'.$prod->thumbnail)}}" alt="">
            @if($gs->is_rating == 1)
            <div class="stars">
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                </div>
            </div>
            @endif
        </div>

        @if($gs->is_cart)
        <div class="item-cart-area">
            @if($prod->product_type == "affiliate")
            <span class="add-to-cart-btn affilate-btn" data-href="{{ route('affiliate.product', $prod->slug) }}">
                {{ __("Buy Now") }}
            </span>
            @else
            @if($prod->emptyStock())
            <span class="add-to-cart-btn cart-out-of-stock">
                <i class="icofont-close-circled"></i> {{ __("Out of Stock!") }}
            </span>
            @else
            @if($gs->is_cart_and_buy_available)
            <span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
                {{ __("Add To Cart") }}
            </span>
            <span class="add-to-cart-quick add-to-cart-btn" data-href="{{ route('product.cart.quickadd',$prod->id) }}">
                {{ __("Buy Now") }}
            </span>
            @else
            <span class="add-to-cart-btn" href="{{ route('front.product', $prod->slug)}}">
                {{ __("Details") }}
            </span>
            @endif
            @endif
            @endif
        </div>
        @else
        <span class="add-to-cart-btn" href="{{ route('front.product', $prod->slug)}}">
            {{ __("Details") }}
        </span>
        @endif

    </a>
    <div class="deal-counter">
        <div data-countdown="{{ $prod->discount_date }}"></div>
    </div>
</div>

@endif
