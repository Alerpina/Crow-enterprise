<div class="info-meta-3">
    <ul class="meta-list">
        @include('front._product-details-info-meta-3-vendor')

        @if(!empty($productt->attributes))
        @php
        $attrArr = json_decode($productt->attributes, true);
        @endphp
        @endif

        @if(!empty($attrArr))

        @if($gs->attribute_clickable)
        @include('front._product-details-attribute-clickable')
        @else
        @include('front._product-details-attribute-normal')
        @endif

        @endif

        @include('front._product-details-info-meta-3-custom')

        @include('front._product-details-info-meta-3-custom-number')

        @if($gs->is_cart)

        @if($productt->product_type == "affiliate")
        <div class="row">
            <li class="addtocart">
                <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"><i class="icofont-cart"></i>
                    {{ __("Buy Now") }}
                </a>
            </li>
        </div>
        @else
        @if($productt->emptyStock())
        <li class="addtocart">
            <a href="javascript:;" class="cart-out-of-stock">
                <i class="icofont-close-circled"></i>
                {{ __("Out of Stock!") }}</a>
        </li>
        @else
        <li class="addtocart">
            <a href="javascript:;" id="addcrt">
                <i class="icofont-shopping-cart"></i>{{ __("Add to Cart") }}
            </a>
        </li>
        <li class="addtocart">
            <a id="qaddcrt" href="javascript:;">
                <i class="icofont-shopping-cart"></i>{{ __("Buy Now") }}
            </a>
        </li>
        @endif
        @endif

        @endif

        @if(Auth::guard('web')->check())
        <li class="favorite">
            <a href="javascript:;" class="add-to-wish" data-href="{{ route('user-wishlist-add',$productt->id) }}">
                <i class="icofont-ui-love-add"></i>
            </a>
        </li>
        @else
        <li class="favorite">
            <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                <i class="icofont-ui-love-add"></i>
            </a>
        </li>
        @endif

        <li class="compare">
            <a href="javascript:;" class="add-to-compare" data-href="{{ route('product.compare.add',$productt->id) }}">
                <i class="icofont-exchange"></i>
            </a>
        </li>
    </ul>
</div>
