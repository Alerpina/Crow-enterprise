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
            @if($productt->show_price)
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
                        <del id="previousprice"
                            style="display:{{($size_price_value >= $previous_price_value)? 'none' : '' }};">
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
            @endif
            <div class="info-meta-2">
                <ul>
                    @if($productt->type == 'License')
                    @if($productt->platform != null)
                    <li>
                        <p>{{ __("Platform") }}: <b>{{ $productt->platform }}</b></p>
                    </li>
                    @endif
                    @if($productt->region != null)
                    <li>
                        <p>{{ __("Region") }}: <b>{{ $productt->region }}</b></p>
                    </li>
                    @endif
                    @if($productt->licence_type != null)
                    <li>
                        <p>{{ __("License Type") }}: <b>{{ $productt->licence_type }}</b></p>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
            @if(!empty($productt->size))
            <div class="product-size">
                <p class="title">{{ __("Size") }} :</p>
                <ul class="siz-list">
                    @php
                    $is_selected = false;
                    @endphp
                    @foreach($productt->size as $key => $data1)
                    <li class="{{ (!$is_selected && (int)$productt->size_qty[$key] > 0) ? 'active' : '' }}">
                        <span class="box {{ ($productt->size_qty[$key] == 0) ? 'disabled' : '' }}">
                            {{$data1 }}
                            <input type="hidden" class="size" value="{{ $data1 }}">
                            <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
                            <input type="hidden" class="size_key" value="{{$key}}">
                            <input type="hidden" class="size_price" value="{{ round($productt->size_price[$key] *
                                            $product_curr->value * (1+($gs->product_percent / 100)),2) }}">
                        </span>
                    </li>
                    @php
                    if(!$is_selected && $productt->size_qty[$key] > 0){
                    $size_qty = $productt->size_qty[$key];
                    $is_selected = true;
                    }
                    @endphp
                    @endforeach
                    <li>
                </ul>
            </div>
            @endif
            @if(!empty($productt->color))
            <div class="product-color">
                <p class="title">{{ __("Color") }} :</p>
                <ul class="color-list">
                    @php
                    $is_selected = false;
                    @endphp
                    @foreach($productt->color as $key => $data1)
                    <li class="{{ (!$is_selected && (int)$productt->color_qty[$key] > 0) ? 'active' : '' }}">
                        <span class="box {{ ((int)$productt->color_qty[$key] == 0) ? 'disabled' : '' }}"
                            data-color="{{ $productt->color[$key] }}"
                            style="background-color: {{ $productt->color[$key] }}">
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
            @endif
            @if(!empty($productt->material) && $productt->stock > 0)
            <div class="product-attributes my-4">
                <strong for="" class="text-capitalize">
                    {{ __("Material") }}:
                </strong>
                <div class="form-group mb-2">
                    <select id="select-materials" class="form-control">
                        @foreach($productt->material as $key => $material)
                        <option value="{{ $key }}" {{ $productt->material_qty[$key] == 0 ?
                            "disabled" : "" }}
                            @if($productt->material_qty[$key] > 0)
                            id="material-option"
                            data-material-qty="{{ $productt->material_qty[$key]}}"
                            data-material-name="{{ $productt->material[$key]}}"
                            data-material-price="{{$productt->material_price[$key]}}"
                            data-material-key="{{$key}}"
                            @endif
                            >
                            {{ $material }}
                        </option>
                        @endforeach
                    </select>
                    <input type="hidden" class="material" id="material_product" value="">
                    <input type="hidden" class="material_qty" id="material_qty_product" value="">
                    <input type="hidden" class="material_key" id="material_key_product" value="">
                    <input type="hidden" class="material_price" id="material_price_product" value="">
                </div>
            </div>
            @endif
            @if(!empty($productt->size))
            <input type="hidden" id="stock"
                value="{{ isset($productt->size_qty[$key]) ? $productt->size_qty[$key] : '' }}">
            @elseif(!empty($productt->color))
            <input type="hidden" id="stock"
                value="{{ isset($productt->color_qty[$key]) ? $productt->color_qty[$key] : '' }}">
            @elseif(!empty($productt->material))
            <input type="hidden" id="stock"
                value="{{ isset($productt->material_qty[$key]) ? $productt->material_qty[$key] : '' }}">
            @else
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




            <div class="info-meta-3">
                <ul class="meta-list">
                    <!-- Marketplace Disabled && Product is not Affiliate -->
                    <!-- or -->
                    <!-- Marketplace Enabled && Product belongs to Vendor -->
                    @if(( !config("features.marketplace") && $productt->product_type != "affiliate")
                    || (config("features.marketplace") && $productt->user->isVendor()))
                    @if(!$productt->emptyStock())
                    <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                        <div class="qty">
                            <ul>
                                <li>
                                    <span class="qtminus">
                                        <i class="icofont-minus"></i>
                                    </span>
                                </li>
                                <li>
                                    <span class="qttotal">1</span>
                                    <input type="hidden" class="max_quantity" id="max_quantity"
                                        value="{{ $productt->max_quantity }}">
                                </li>
                                <li>
                                    <span class="qtplus">
                                        <i class="icofont-plus"></i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @endif
                    @if(!empty($productt->attributes))
                    @php
                    $attrArr = json_decode($productt->attributes, true);
                    @endphp
                    @endif
                    @if(!empty($attrArr))
                    @if($gs->attribute_clickable)
                    <div class="product-attributes my-4">
                        <div class="row">
                            @foreach($attrArr as $attrKey => $attrVal)
                            @if(array_key_exists("details_status",$attrVal) &&
                            $attrVal['details_status'] == 1)
                            @if ($attr_search =
                            App\Models\Attribute::where('input_name',$attrKey)->first())
                            <div class="col-lg-12">
                                <div class="form-group mb-2">
                                    <strong for="" class="text-capitalize">
                                        {{ App\Models\Attribute::where('input_name',
                                        $attrKey)->first()->name }}:
                                    </strong>
                                    <div class="">
                                        @if($gs->is_attr_cards)
                                        @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card border-dark mb-3">
                                                    <div class="card-header">
                                                        <input type="radio" id="{{$attrKey}}{{ $optionKey }}"
                                                            name="{{ $attrKey }}"
                                                            class="custom-control-input product-attr"
                                                            data-key="{{ $attrKey }}" data-price="{{
                                                                        $attrVal['prices'][$optionKey] *
                                                                        $product_curr->value *
                                                                        (1+($gs->product_percent / 100))}}"
                                                            value="{{ $optionKey }}" {{ $loop->first
                                                        ? 'checked' : '' }}>
                                                        @if($loop->count > 1)
                                                        <label class="custom-control-label"
                                                            for="{{$attrKey}}{{ $optionKey }}">
                                                            {{App\Models\AttributeOption::find($optionVal)->name}}
                                                            @if
                                                            (!empty($attrVal['prices'][$optionKey])
                                                            &&
                                                            $attr_search->show_price == 1)
                                                            {{$product_curr->sign}}
                                                            {{number_format(
                                                            $attrVal['prices'][$optionKey] *
                                                            $product_curr->value *
                                                            (1+($gs->product_percent / 100)),
                                                            $product_curr->decimal_digits,
                                                            $product_curr->decimal_separator,
                                                            $product_curr->thousands_separator)}}
                                                            @endif
                                                        </label>
                                                        @else
                                                        <div style="margin-left: -1.5rem">
                                                            -
                                                            {{App\Models\AttributeOption::find($optionVal)->name}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="card-body text-dark">
                                                        <small>{{
                                                            App\Models\AttributeOption::find($optionVal)->description
                                                            }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                        @if (App\Models\AttributeOption::where('id',
                                        $optionVal)->first())
                                        <div class="custom-control custom-radio">
                                            <input type="hidden" class="keys" value="">
                                            <input type="hidden" class="values" value="">
                                            <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}"
                                                class="custom-control-input product-attr" data-key="{{ $attrKey }}"
                                                data-price="{{
                                                                    $attrVal['prices'][$optionKey] *
                                                                    $product_curr->value *
                                                                    (1+($gs->product_percent / 100))}}"
                                                value="{{ $optionKey }}" {{ $loop->first ? 'checked'
                                            : '' }}>
                                            @if($loop->count > 1)
                                            <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">
                                                {{App\Models\AttributeOption::find($optionVal)->name}}
                                                @if (!empty($attrVal['prices'][$optionKey]) &&
                                                $attr_search->show_price == 1)
                                                @if ($attrVal['prices'][$optionKey] >= 0)
                                                +
                                                @endif
                                                {{$product_curr->sign}}
                                                {{number_format(
                                                $attrVal['prices'][$optionKey] *
                                                $product_curr->value * (1+($gs->product_percent /
                                                100)),
                                                $product_curr->decimal_digits,
                                                $product_curr->decimal_separator,
                                                $product_curr->thousands_separator)}}
                                                @endif
                                            </label>
                                            @else
                                            <div style="margin-left: -1.5rem">
                                                -
                                                {{App\Models\AttributeOption::find($optionVal)->name}}
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="product-attributes my-4">
                        <div class="row">
                            @foreach($attrArr as $attrKey => $attrVal)
                            @if(array_key_exists("details_status",$attrVal) &&
                            $attrVal['details_status'] == 1)
                            @if ($attr_search = App\Models\Attribute::where('input_name',
                            $attrKey)->first())
                            <div class="col-lg-12">
                                <div class="form-group mb-2">
                                    <strong for="" class="text-capitalize">
                                        {{ App\Models\Attribute::where('input_name',
                                        $attrKey)->first()->name }}:
                                    </strong>
                                    <div class="">
                                        @if($gs->is_attr_cards)
                                        @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card border-dark mb-3">
                                                    <div class="card-header">
                                                        <input type="radio" id="{{$attrKey}}{{ $optionKey }}"
                                                            name="{{ $attrKey }}"
                                                            class="custom-control-input product-attr"
                                                            data-key="{{ $attrKey }}" data-price="{{
                                                                        $attrVal['prices'][$optionKey] *
                                                                        $product_curr->value *
                                                                        (1+($gs->product_percent / 100))}}"
                                                            value="{{ $optionKey }}" {{ $loop->first
                                                        ? 'checked' : '' }}>
                                                        @if($loop->count > 1)
                                                        <label class="custom-control-label"
                                                            for="{{$attrKey}}{{ $optionKey }}">
                                                            {{App\Models\AttributeOption::find($optionVal)->name}}
                                                            @if
                                                            (!empty($attrVal['prices'][$optionKey])
                                                            &&
                                                            $attr_search->show_price == 1)
                                                            {{$product_curr->sign}}
                                                            {{number_format(
                                                            $attrVal['prices'][$optionKey] *
                                                            $product_curr->value *
                                                            (1+($gs->product_percent / 100)),
                                                            $product_curr->decimal_digits,
                                                            $product_curr->decimal_separator,
                                                            $product_curr->thousands_separator)}}
                                                            @endif
                                                        </label>
                                                        @else
                                                        <div style="margin-left: -1.5rem">
                                                            -
                                                            {{App\Models\AttributeOption::find($optionVal)->name}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="card-body text-dark">
                                                        <small>{{
                                                            App\Models\AttributeOption::find($optionVal)->description
                                                            }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                        @if (App\Models\AttributeOption::where('id',
                                        $optionVal)->first())
                                        <div class="custom-control custom-radio">
                                            <div style="margin-left: -1.5rem">
                                                -
                                                {{App\Models\AttributeOption::find($optionVal)->name}}
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endif

                    @if(env("ENABLE_CUSTOM_PRODUCT"))
                    @if($productt->category->is_customizable)
                    <h4 class="customize-title" style="text-transform: uppercase;">
                        {{__('Customize your product:')}}</h4>
                    <div class="mt-4 mb-4 customizable-item">
                        <input type="text" class="form-control col-lg-8 mt-2" name="customizable_name"
                            id="customizable_name" value="" style="margin-top: -13px;"
                            placeholder="{{ __('Enter your name') }}">
                        <div class="mt-4">
                            @include('includes.admin.form-error')
                            <input type="checkbox" id="customLogo" class="checkclick" onclick="showLogoField()"
                                value="1">
                            <label for="customLogo">{{ __('Upload Logo Image') }}</label>
                        </div>

                        <div class="mt-4" style="display: none;" id="logoField">
                            <form method="POST" enctype="multipart/form-data" id="logoUpload">
                                @csrf
                                <div class="img-upload">
                                    <label for="image-upload" class="img-label mt-4" id="image-label"><i
                                            class="icofont-upload-alt"></i>{{
                                        __('Upload Image') }}</label>
                                    <input type="file" name="customizable_logo" class="img-upload" id="image-upload">
                                    <h4 class="customize-title">{{ __('Accepted formats: png, jpg
                                        and svg.') }}</h4><br>
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary uploadLogoBtn"
                                            style="margin-top: -10px; margin-left: 10px">
                                            <p style="">{{ __('Upload Logo') }}</p>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <input type="hidden" name="customizable_gallery_count" id="customizable_gallery_count"
                        value="{{ count($category_gallery) }}">
                    @if(count($category_gallery) > 0)
                    <div class="row">
                        <div class="d-flex">
                            @php
                            $i=1;
                            @endphp
                            <img src="" id="currentGallery" class="image-responsive" width="100" alt=""
                                style="display:none; border-radius: 50px; height:100px; margin-top: -6px;">
                            <span class="overlayCurrentSpan" style="display:none"><i
                                    class="icofont-check-alt icofont-4x" style="color: #fff"></i></span>
                            <div class="textureCurrentOverlay" style="position: relative; display:none"></div>
                            @foreach($category_gallery as $cat_gal)
                            <input type="hidden" id="customizable_gallery" value="">
                            <a class="textureIcons" id="textureIcons" onclick="" style="cursor: pointer;">
                                <img class="textureImages" width="80"
                                    src="{{asset('storage/images/thumbnails/' . $cat_gal->customizable_gallery)}}"
                                    style="border-radius: 50px; margin-left: 5px;">
                                <div class="textureOverlay" style="position: relative;"></div>
                                <span class="overlaySpan"><i class="icofont-ui-add icofont-1x"
                                        style="color: #fff"></i></span>
                            </a>

                            @php
                            $i++;
                            @endphp

                            @if($i == 4)

                            @break
                            @endif

                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="allOptions d-flex mt-4 ml-2">
                                <a class="allOptionsAnchor" id="openBtn" style="cursor:pointer;">
                                    <p style="font-weight: 600;">Ver todas as opções</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <input type="checkbox" name="agree_terms" id="agreeCustomTerms" value="" class="checkclick">
                            <label for="agreeCustomTerms" style="font-weight:500;">{{ __('I reviewed
                                my choices.') }}</label>
                        </div>
                    </div>
                    @endif
                    @endif

                    @if(env("ENABLE_CUSTOM_PRODUCT_NUMBER"))
                    <input type="hidden" id="is_customizable_number" name="is_customizable_number"
                        value="{{ $productt->category->is_customizable_number }}">
                    @if($productt->category->is_customizable_number == 1)
                    <h4 class="customize-title" style="text-transform: uppercase;">
                        {{__('Customize your product:')}}</h4>
                    <div class="mt-4 mb-4 customizable-item">
                        <input type="text" class="form-control col-lg-8 mt-2" name="customizable_name"
                            id="customizable_name" value="" style="margin-top: -13px;"
                            placeholder="{{ __('Enter your name') }}">
                        <input type="number" min="1" max="99" maxlength="2"
                            oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                            class="form-control col-lg-8 mt-2" name="customizable_number" id="customizable_number"
                            value="" style="margin-top: -13px;" placeholder="{{ __('Enter the number') }}">
                    </div>
                    @endif
                    @endif

                    @if($gs->is_cart)
                    @if($productt->product_type == "affiliate")
                    <div class="row">
                        <li class="addtocart">
                            <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"><i
                                    class="icofont-cart"></i>
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
                        <a href="javascript:;" class="add-to-wish"
                            data-href="{{ route('user-wishlist-add',$productt->id) }}">
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
                        <a href="javascript:;" class="add-to-compare"
                            data-href="{{ route('product.compare.add',$productt->id) }}">
                            <i class="icofont-exchange"></i>
                        </a>
                    </li>
                </ul>
            </div>
            @if($gs->is_back_in_stock && $productt->emptyStock())
            @php
            $url = $gs->privacy_policy ? true : false;
            $url_terms = $gs->crow_policy ? true : false;
            @endphp
            <form class="form-group" action="{{ route('product.backinstock', $productt->id) }}" method="POST">
                @csrf
                <label style="font-weight:200;">{{ __('Please enter your e-mail to be notified when
                    the product is back in stock.') }}</label>
                <label for="email">{{ __("Email Address") }}</label>
                <input style="margin-bottom: 1rem;" class="form-control form-backinstock" id="email" type="email"
                    name="email" value="{{ old('email') }}" required>
                <input style="float: right;" type="submit" class="btn btn-primary btn-backinstock"
                    value="{{ __('Notify Me') }}">
                <div class="form-forgot-pass">
                    <div class="left">
                        <input type="checkbox" name="agree_privacy_policy" id="agree_privacy_policy">
                        <label for="agree_privacy_policy">Concordo com a <a target="_blank"
                                href="{{ $url ? route('front.privacypolicy') : ''  }}">Política de
                                Privacidade</a> e os <a target="_blank"
                                href="{{ $url_terms ? route('front.crowpolicy') : ''  }}">Termos de
                                Uso</a>.</label>
                    </div>
                </div>
            </form>
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
