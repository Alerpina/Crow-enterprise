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
                                            <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}"
                                                class="custom-control-input product-attr" data-key="{{ $attrKey }}"
                                                data-price="{{
                                                            $attrVal['prices'][$optionKey] *
                                                            $product_curr->value *
                                                            (1+($gs->product_percent / 100))}}"
                                                value="{{ $optionKey }}" {{ $loop->first
                                            ? 'checked' : '' }}>
                                            @if($loop->count > 1)
                                            <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">
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
                                    class="custom-control-input product-attr" data-key="{{ $attrKey }}" data-price="{{
                                                        $attrVal['prices'][$optionKey] *
                                                        $product_curr->value *
                                                        (1+($gs->product_percent / 100))}}" value="{{ $optionKey }}" {{
                                    $loop->first ? 'checked'
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
                                            <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}"
                                                class="custom-control-input product-attr" data-key="{{ $attrKey }}"
                                                data-price="{{
                                                            $attrVal['prices'][$optionKey] *
                                                            $product_curr->value *
                                                            (1+($gs->product_percent / 100))}}"
                                                value="{{ $optionKey }}" {{ $loop->first
                                            ? 'checked' : '' }}>
                                            @if($loop->count > 1)
                                            <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">
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
            <input type="text" class="form-control col-lg-8 mt-2" name="customizable_name" id="customizable_name"
                value="" style="margin-top: -13px;" placeholder="{{ __('Enter your name') }}">
            <div class="mt-4">
                @include('includes.admin.form-error')
                <input type="checkbox" id="customLogo" class="checkclick" onclick="showLogoField()" value="1">
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
                <span class="overlayCurrentSpan" style="display:none"><i class="icofont-check-alt icofont-4x"
                        style="color: #fff"></i></span>
                <div class="textureCurrentOverlay" style="position: relative; display:none"></div>
                @foreach($category_gallery as $cat_gal)
                <input type="hidden" id="customizable_gallery" value="">
                <a class="textureIcons" id="textureIcons" onclick="" style="cursor: pointer;">
                    <img class="textureImages" width="80"
                        src="{{asset('storage/images/thumbnails/' . $cat_gal->customizable_gallery)}}"
                        style="border-radius: 50px; margin-left: 5px;">
                    <div class="textureOverlay" style="position: relative;"></div>
                    <span class="overlaySpan"><i class="icofont-ui-add icofont-1x" style="color: #fff"></i></span>
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
            <input type="text" class="form-control col-lg-8 mt-2" name="customizable_name" id="customizable_name"
                value="" style="margin-top: -13px;" placeholder="{{ __('Enter your name') }}">
            <input type="number" min="1" max="99" maxlength="2"
                oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                class="form-control col-lg-8 mt-2" name="customizable_number" id="customizable_number" value=""
                style="margin-top: -13px;" placeholder="{{ __('Enter the number') }}">
        </div>
        @endif
        @endif

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
