<div class="col-lg-7">
    <div class="right-area">
        <div class="product-info">

            @if($isAdmin)
            <div class="mybadge1">
                {{ __('Viewing as Admin')}}
            </div>
            @endif

            <h4 class="product-name">{{ $productt->name }}</h4>

            @if(($productt->ref_code != null) && ($admstore->reference_code == 1))
            <h4>
                <span class="badge badge-primary" style="background-color: {{$admstore->ref_color}}">{{ __('Reference
                    Code') }}:
                    {{ $productt->ref_code }}
                </span>
            </h4>
            @endif

            @include('front._product-details-info-meta-1')

            @if($productt->show_price)
            @include('front._product-details-show-price')
            @endif

            @include('front._product-details-info-meta-2')

            @if(!empty($productt->size))
            @include('front._product-details-size')
            @endif

            @if(!empty($productt->color))
            @include('front._product-details-color')
            @endif

            @if(!empty($productt->material) && $productt->stock > 0)
            @include('front._product-details-material')
            @endif

            @php
            $stck = (string) $productt->stock;
            @endphp

            @if($stck != null)
            <input type="hidden" id="stock" value="{{ $stck }}">
            @elseif($productt->type != 'Physical')
            <input type="hidden" id="stock" value="0">
            @else
            <input type="hidden" id="stock" value="">
            @endif

            <input type="hidden" id="product_price"
                value="{{ round($productt->vendorPrice(),2) * $product_curr->value,2 }}">
            <input type="hidden" id="product_id" value="{{ $productt->id }}">
            <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
            <input type="hidden" id="dec_sep" value="{{ $product_curr->decimal_separator }}">
            <input type="hidden" id="tho_sep" value="{{ $product_curr->thousands_separator }}">
            <input type="hidden" id="dec_dig" value="{{ $product_curr->decimal_digits }}">
            <input type="hidden" id="dec_sep2" value="{{ $first_curr->decimal_separator }}">
            <input type="hidden" id="tho_sep2" value="{{ $first_curr->thousands_separator }}">
            <input type="hidden" id="dec_dig2" value="{{ $first_curr->decimal_digits }}">
            <input type="hidden" id="curr_sign" value="{{ $product_curr->sign }}">
            <input type="hidden" id="first_sign" value="{{ $first_curr->sign }}">
            <input type="hidden" id="currency_value" value="{{ $product_curr->value }}">
            <input type="hidden" id="curr_value" value="{{ $product_curr->value }}">

            @include('front._product-details-info-meta-3')


            @if($gs->is_back_in_stock && $productt->emptyStock())
            @include('front._product-details-back-in-stock')
            @endif

            <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                {{ __("Share on")}}:
                <br>
                <ul class="link-list social-links">
                    <li>
                        <a class="facebook a2a_button_facebook" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a class="twitter a2a_button_twitter" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a class="whatsapp a2a_button_whatsapp" href="">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </li>
                    <li>
                        <a class="copy a2a_button_copy_link" href="">
                            <i class="fas fa-copy"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <script async src="https://static.addtoany.com/menu/page.js"></script>

            @if($productt->ship != null)
            <p class="estimate-time">{{ __("Estimated Shipping Time") }}: <b>
                    {{ $productt->ship }}</b></p>
            @endif

            @if($productt->sku != null)
            <p class="p-sku">
                {{ __("Product SKU") }}: <span class="idno">{{ $productt->sku }}</span>
            </p>
            @endif

            @if($gs->is_report)

            {{-- PRODUCT REPORT SECTION --}}
            @if(Auth::guard('web')->check())
            <div class="report-area">
                <a href="javascript:;" data-toggle="modal" data-target="#report-modal">
                    <i class="fas fa-flag"></i> {{ __("Report This Item") }}
                </a>
            </div>
            @else
            <div class="report-area">
                <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                    <i class="fas fa-flag"></i> {{ __("Report This Item") }}
                </a>
            </div>
            @endif

            {{-- PRODUCT REPORT SECTION ENDS --}}
            @endif
        </div>
    </div>
</div>
