<div class="info-meta-1">
    <ul>
        @if($productt->type == 'Physical')
        @if($productt->emptyStock())
        <li class="product-outstook">
            <p>
                <i class="icofont-close-circled"></i>
                {{ __("Out of Stock!") }}
            </p>
        </li>
        @else
        <li class="product-isstook">
            <p>
                @if($gs->show_stock)
                @if(empty($productt->size) && empty($productt->color) &&
                empty($productt->material))
                <i class="icofont-check-circled"></i>
                {{ $productt->stock }}
                {{ __("In Stock") }}
                @endif

                @if(!empty($productt->color))
                <i class="icofont-check-circled"></i>
                <span id="stock_qty">{{ isset($productt->color_qty[0]) ?
                    $productt->color_qty[0] : $productt->stock }}</span>
                {{ __("In Stock") }}
                @endif

                @if(!empty($productt->material))
                <i class="icofont-check-circled"></i>
                <span id="stock_qty">
                    {{$material_stock}}
                </span>
                {{ __("In Stock") }}
                @endif

                @if(!empty($productt->size))
                <i class="icofont-check-circled"></i>
                <span id="stock_qty">{{ $gs->show_stock == 0 ? '' :
                    $productt->size_qty[0] }}</span>
                {{ __("In Stock") }}
                @endif
                @endif
            </p>
        </li>
        @endif
        @endif
        @if($gs->is_rating == 1)
        <li>
            <div class="ratings">
                <div class="empty-stars"></div>
                <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%">
                </div>
            </div>
        </li>
        <li class="review-count">
            <p>{{count($productt->ratings)}} {{ __("Review(s)") }}</p>
        </li>
        @endif
        @if($productt->product_condition != 0)
        <li>
            <div class="{{ $productt->product_condition == 2 ? 'mybadge' :
                                'mybadge1' }}">
                {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
            </div>
        </li>
        @endif
    </ul>
</div>
