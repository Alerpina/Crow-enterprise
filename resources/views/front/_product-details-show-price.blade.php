<div class="product-price">
    @if($gs->show_product_prices)
    <p class="title">{{ __("Price") }} :</p>
    @endif

    @php
    if ($gs->switch_highlight_currency) {
    $highlight = $productt->firstCurrencyPrice();
    $small = $productt->showPrice();
    } else {
    $highlight = $productt->showPrice();
    $small = $productt->firstCurrencyPrice();
    }
    @endphp
    @if(!config("features.marketplace"))
    <p class="price"><span id="sizeprice">{{ $highlight }}</span>
        @php
        $size_price_value = $productt->vendorPrice() * $product_curr->value;
        $previous_price_value = $productt->previous_price * $product_curr->value *
        (1+($gs->product_percent / 100));
        @endphp
        <small>
            <del id="previousprice" style="display:{{($size_price_value >= $previous_price_value)? 'none' : '' }};">
                {{$productt->showPreviousPrice() }}
            </del>
        </small>
        <input type="hidden" id="previous_price_value" value="{{ round($previous_price_value,2) }}">
        @if($curr->id != $scurrency->id)
        <small><span id="originalprice">{{ $small }}</span></small>
        @endif
    </p>
    @else
    <p class="price">
        <span id="originalprice">
            {{ $productt->showVendorMinPrice() }} até {{ $productt->showVendorMaxPrice()
            }}
            @if($curr->id != $scurrency->id)
            <small><span id="originalprice">{{ $small }}</span></small>
            @endif
    </p>
    @endif
    @if($productt->youtube != null)
    <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
        <i class="fas fa-play"></i>
    </a>
    @endif
</div>
