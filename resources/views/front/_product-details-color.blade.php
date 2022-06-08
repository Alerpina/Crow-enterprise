<div class="product-color">
    <p class="title">{{ __("Color") }} :</p>
    <ul class="color-list">
        @php
        $is_selected = false;
        @endphp
        @foreach($productt->color as $key => $data1)
        <li class="{{ (!$is_selected && (int)$productt->color_qty[$key] > 0) ? 'active' : '' }}">
            <span class="box {{ ((int)$productt->color_qty[$key] == 0) ? 'disabled' : '' }}"
                data-color="{{ $productt->color[$key] }}" style="background-color: {{ $productt->color[$key] }}">
                <input type="hidden" class="color" value="{{ $data1 }}">
                <input type="hidden" class="color_qty"
                    value="{{ isset($productt->color_qty[$key]) ? $productt->color_qty[$key] : '' }}">
                <input type="hidden" class="color_key" value="{{$key}}">
                <input type="hidden" class="color_price"
                    value="{{ isset($productt->color_price[$key]) ? round($productt->color_price[$key] * $product_curr->value * (1+($gs->product_percent / 100)),2) : '' }}">
            </span>
        </li>
        @php
        if(!$is_selected && $productt->color_qty[$key] > 0){
        $color_qty = $productt->color_qty[$key];
        $is_selected = true;
        }
        @endphp
        @endforeach
    </ul>
</div>
