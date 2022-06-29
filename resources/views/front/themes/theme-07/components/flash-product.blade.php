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
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                        </span>
                        @else
                        <span rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal" id="wish-btn"
                            data-target="#comment-log-reg" data-placement="right">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                                    <path d="M505.918,236.117c-26.651-43.587-62.485-78.609-107.497-105.065c-45.015-26.457-92.549-39.687-142.608-39.687
																			c-50.059,0-97.595,13.225-142.61,39.687C68.187,157.508,32.355,192.53,5.708,236.117C1.903,242.778,0,249.345,0,255.818
																			c0,6.473,1.903,13.04,5.708,19.699c26.647,43.589,62.479,78.614,107.495,105.064c45.015,26.46,92.551,39.68,142.61,39.68
																			c50.06,0,97.594-13.176,142.608-39.536c45.012-26.361,80.852-61.432,107.497-105.208c3.806-6.659,5.708-13.223,5.708-19.699
																			C511.626,249.345,509.724,242.778,505.918,236.117z M194.568,158.03c17.034-17.034,37.447-25.554,61.242-25.554
																			c3.805,0,7.043,1.336,9.709,3.999c2.662,2.664,4,5.901,4,9.707c0,3.809-1.338,7.044-3.994,9.704
																			c-2.662,2.667-5.902,3.999-9.708,3.999c-16.368,0-30.362,5.808-41.971,17.416c-11.613,11.615-17.416,25.603-17.416,41.971
																			c0,3.811-1.336,7.044-3.999,9.71c-2.667,2.668-5.901,3.999-9.707,3.999c-3.809,0-7.044-1.334-9.71-3.999
																			c-2.667-2.666-3.999-5.903-3.999-9.71C169.015,195.482,177.535,175.065,194.568,158.03z M379.867,349.04
																			c-38.164,23.12-79.514,34.687-124.054,34.687c-44.539,0-85.889-11.56-124.051-34.687s-69.901-54.2-95.215-93.222
																			c28.931-44.921,65.19-78.518,108.777-100.783c-11.61,19.792-17.417,41.207-17.417,64.236c0,35.216,12.517,65.329,37.544,90.362
																			s55.151,37.544,90.362,37.544c35.214,0,65.329-12.518,90.362-37.544s37.545-55.146,37.545-90.362
																			c0-23.029-5.808-44.447-17.419-64.236c43.585,22.265,79.846,55.865,108.776,100.783C449.767,294.84,418.031,325.913,379.867,349.04
																			z" />
                                </g>
                            </svg>
                        </span>
                    </li>
                    <li>
                        <span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"
                            data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                            data-placement="right">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.016 512.016"
                                style="enable-background:new 0 0 512.016 512.016;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M496.008,79.997h-368v-48c0-6.464-3.904-12.32-9.888-14.784s-12.832-1.088-17.44,3.456l-96,96
																				c-6.24,6.24-6.24,16.384,0,22.624l96,96c4.608,4.576,11.456,5.952,17.44,3.488s9.888-8.32,9.888-14.784v-48h368
																				c8.832,0,16-7.168,16-16v-64C512.008,87.133,504.84,79.997,496.008,79.997z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M507.336,372.701l-96-96.032c-4.576-4.576-11.456-5.952-17.44-3.456c-5.984,2.496-9.888,8.32-9.888,14.784v48h-368
																				c-8.832,0-16,7.168-16,16v64c0,8.832,7.168,16,16,16h368v48c0,6.464,3.904,12.32,9.888,14.784
																				c5.984,2.496,12.864,1.12,17.44-3.456l96-96C513.576,389.085,513.576,378.941,507.336,372.701z" />
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
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                        </span>
                        @else
                        <span rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal" id="wish-btn"
                            data-target="#comment-log-reg" data-placement="right">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                                    <path d="M505.918,236.117c-26.651-43.587-62.485-78.609-107.497-105.065c-45.015-26.457-92.549-39.687-142.608-39.687
																			c-50.059,0-97.595,13.225-142.61,39.687C68.187,157.508,32.355,192.53,5.708,236.117C1.903,242.778,0,249.345,0,255.818
																			c0,6.473,1.903,13.04,5.708,19.699c26.647,43.589,62.479,78.614,107.495,105.064c45.015,26.46,92.551,39.68,142.61,39.68
																			c50.06,0,97.594-13.176,142.608-39.536c45.012-26.361,80.852-61.432,107.497-105.208c3.806-6.659,5.708-13.223,5.708-19.699
																			C511.626,249.345,509.724,242.778,505.918,236.117z M194.568,158.03c17.034-17.034,37.447-25.554,61.242-25.554
																			c3.805,0,7.043,1.336,9.709,3.999c2.662,2.664,4,5.901,4,9.707c0,3.809-1.338,7.044-3.994,9.704
																			c-2.662,2.667-5.902,3.999-9.708,3.999c-16.368,0-30.362,5.808-41.971,17.416c-11.613,11.615-17.416,25.603-17.416,41.971
																			c0,3.811-1.336,7.044-3.999,9.71c-2.667,2.668-5.901,3.999-9.707,3.999c-3.809,0-7.044-1.334-9.71-3.999
																			c-2.667-2.666-3.999-5.903-3.999-9.71C169.015,195.482,177.535,175.065,194.568,158.03z M379.867,349.04
																			c-38.164,23.12-79.514,34.687-124.054,34.687c-44.539,0-85.889-11.56-124.051-34.687s-69.901-54.2-95.215-93.222
																			c28.931-44.921,65.19-78.518,108.777-100.783c-11.61,19.792-17.417,41.207-17.417,64.236c0,35.216,12.517,65.329,37.544,90.362
																			s55.151,37.544,90.362,37.544c35.214,0,65.329-12.518,90.362-37.544s37.545-55.146,37.545-90.362
																			c0-23.029-5.808-44.447-17.419-64.236c43.585,22.265,79.846,55.865,108.776,100.783C449.767,294.84,418.031,325.913,379.867,349.04
																			z" />
                                </g>
                            </svg>
                        </span>
                    </li>
                    <li>
                        <span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"
                            data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                            data-placement="right">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.016 512.016"
                                style="enable-background:new 0 0 512.016 512.016;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M496.008,79.997h-368v-48c0-6.464-3.904-12.32-9.888-14.784s-12.832-1.088-17.44,3.456l-96,96
																				c-6.24,6.24-6.24,16.384,0,22.624l96,96c4.608,4.576,11.456,5.952,17.44,3.488s9.888-8.32,9.888-14.784v-48h368
																				c8.832,0,16-7.168,16-16v-64C512.008,87.133,504.84,79.997,496.008,79.997z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M507.336,372.701l-96-96.032c-4.576-4.576-11.456-5.952-17.44-3.456c-5.984,2.496-9.888,8.32-9.888,14.784v48h-368
																				c-8.832,0-16,7.168-16,16v64c0,8.832,7.168,16,16,16h368v48c0,6.464,3.904,12.32,9.888,14.784
																				c5.984,2.496,12.864,1.12,17.44-3.456l96-96C513.576,389.085,513.576,378.941,507.336,372.701z" />
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
