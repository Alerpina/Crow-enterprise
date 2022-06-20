@extends('front.themes.' . env('THEME', 'theme-01') . '.layout')
@section('styles')
@parent

<style type="text/css">
    .root.root--in-iframe {
        background: #4682b447 !important;
    }

    .button1 {
        display: flex;
        justify-content: center;
    }

    .center-buttons {
        display: flex;
        justify-content: center;
    }

    .none {
        display: none;
    }

    .radio-design input[type="radio"]~label .punto-option {
        display: none;
    }

    .radio-design input[type="radio"]:checked~label .punto-option {
        display: block;
    }
</style>
@endsection
@section('content')
<input type="hidden" id="has_temporder" value="false">
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.index') }}">
                            {{ __("Home") }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.checkout') }}">
                            {{ __("Checkout") }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- Check Out Area Start -->
<section class="checkout">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="checkout-area mb-0 pb-0">
                    <div class="checkout-process">
                        <ul class="nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-step1-tab" data-toggle="pill" href="#pills-step1"
                                    role="tab" aria-controls="pills-step1" aria-selected="true">
                                    <span>1</span> {{ __("Address") }}
                                    <i class="far fa-address-card"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" id="pills-step2-tab" data-toggle="pill" href="#pills-step2"
                                    role="tab" aria-controls="pills-step2" aria-selected="false">
                                    <span>2</span> {{ __("Orders") }}
                                    <i class="fas fa-dolly"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" id="pills-step3-tab" data-toggle="pill" href="#pills-step3"
                                    role="tab" aria-controls="pills-step3" aria-selected="false">
                                    <span>3</span> {{ __("Payment") }}
                                    <i class="far fa-credit-card"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">

                <div class="preloader" id="preloader_checkout" style="background: url({{asset('storage/images/'.$gs->loader)}}) no-repeat scroll center center;
            background-color: rgba(0,0,0,0.5);
            display: none">
                </div>

                <form id="myform" action="" method="POST" class="checkoutform">
                    @include('includes.form-success')
                    @include('includes.form-error')
                    {{ csrf_field() }}

                    <div class="checkout-area">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-step1" role="tabpanel"
                                aria-labelledby="pills-step1-tab">
                                <div class="content-box">
                                    <div class="content">
                                        <div class="personal-info">
                                            <div class="row">
                                                <div class="col-lg-12  mt-3">
                                                    <p><small>* {{ __("indicates a required field") }}</small></p>
                                                </div>
                                            </div>
                                            <h5 class="title">
                                                {{ __("Personal Information") }} :
                                            </h5>
                                            @if(Session::has('session_order'))
                                            <div class="billing-address">
                                                <!-- CLASSE INSERIDA APENAS PARA FORMATAÇÃO DOS CAMPOS NO FORM -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" pattern="^(\S*)\s+(.*)$" id="personal-name"
                                                            class="form-control" name="personal_name"
                                                            placeholder="{{ __(" Full Name") }}" title="{{  __(" Input
                                                            first name and last name") }}"
                                                            value="{{ session()->get('session_order')['customer_name'] }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="email" id="personal-email" class="form-control"
                                                            name="personal_email" placeholder="{{ __(" Enter Your
                                                            Email") }}"
                                                            value="{{ session()->get('session_order')['customer_email'] }}">
                                                    </div>
                                                </div>
                                            </div>

                                            @if(!Auth::check())
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <input class="styled-checkbox" id="open-pass" type="checkbox"
                                                        value="1" name="pass_check">
                                                    <label for="open-pass">{{ __("Create an account ?") }}</label>
                                                </div>
                                            </div>
                                            <div class="row set-account-pass d-none">
                                                <div class="col-lg-6">
                                                    <input type="password" name="personal_pass" id="personal-pass"
                                                        class="form-control" placeholder="{{ __(" Enter Your Password")
                                                        }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="password" name="personal_confirm"
                                                        id="personal-pass-confirm" class="form-control"
                                                        placeholder="{{ __(" Confirm Your Password") }}">
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="billing-address">
                                            <h5 class="title">
                                                {{ __("Billing Details") }}
                                            </h5>
                                            <div class="row">
                                                <div class="col-lg-6 {{ $digital == 1 ? 'd-none' : '' }}">
                                                    <select class="form-control" id="shipop" name="shipping" required=""
                                                        style="margin-bottom: 10px;">
                                                        <option value="shipto">{{ __("Ship To Address") }}</option>
                                                        <option value="pickup">{{ __("Pick Up") }}</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6 d-none" id="shipshow">
                                                    <select class="form-control" name="pickup_location"
                                                        style="margin-bottom: 10px;">
                                                        @foreach($pickups as $pickup)
                                                        <option value="{{$pickup->location}}">{{$pickup->location}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="name" id="billName"
                                                        placeholder="{{ __(" Full Name") }} *" required=""
                                                        pattern="^(\S*)\s+(.*)$" title="{{  __(" Input first name and
                                                        last name") }}"
                                                        value="{{ session()->get('session_order')['customer_name'] }}">
                                                </div>

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="customer_document"
                                                        id="billCpf" placeholder="{{ $customer_doc_str }} *" required=""
                                                        pattern="[0-9]+" title="{{ __(" Field only accepts numbers") }}"
                                                        value="{{ session()->get('session_order')['customer_document'] }}">
                                                </div>

                                                @if($gs->is_zip_validation)
                                                <div class="col-lg-6">
                                                    <input class="form-control js-zipcode" type="text" name="zip"
                                                        data-type="bill" id="billZip" placeholder="{{ __(" Postal Code")
                                                        }}" required=""
                                                        value="{{ session()->get('session_order')['customer_zip'] }}">
                                                </div>
                                                @else
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="zip" data-type="bill"
                                                        id="zip" placeholder="{{ __(" Postal Code") }}" required=""
                                                        value="{{ session()->get('session_order')['customer_zip'] }}">
                                                </div>
                                                @endif

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="phone" id="billPhone"
                                                        placeholder="{{ __(" Phone Number") }} *" required=""
                                                        value="{{ session()->get('session_order')['customer_phone'] }}">
                                                </div>

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="email" id="billEmail"
                                                        placeholder="{{ __(" Email") }} *" required=""
                                                        value="{{ session()->get('session_order')['customer_email'] }}">
                                                </div>

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="address"
                                                        id="billAddress" placeholder="{{ __(" Address") }} *"
                                                        required=""
                                                        value="{{ session()->get('session_order')['customer_address'] }}">
                                                </div>

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="address_number"
                                                        id="billAdressNumber" placeholder="{{ __('Number') }} *"
                                                        required=""
                                                        value="{{ session()->get('session_order')['customer_address_number'] }}">
                                                </div>

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="complement"
                                                        id="billComplement" placeholder="{{ __('Complement') }} *"
                                                        value="{{ session()->get('session_order')['customer_complement'] }}">
                                                </div>

                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="district"
                                                        id="billDistrict" placeholder="{{ __('District') }} *"
                                                        value="{{ session()->get('session_order')['customer_district'] }}">
                                                </div>

                                                <div class="col-lg-6">
                                                    <select class="form-control js-country" name="country"
                                                        data-type="bill" id="billCountry" required="">
                                                        <option value="" data-code="">{{__('Select Country')}} *
                                                        </option>
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" {{ (session()->
                                                            get('session_order')['customer_country_id'] == $country->id)
                                                            ? 'selected' : '' }}
                                                            data-code="{{$country->country_code}}">
                                                            {{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">
                                                    <select class="form-control js-state" name="state" data-type="bill"
                                                        id="billState" required="">
                                                        <option
                                                            value="{{ session()->get('session_order')['customer_state_id']  }}">
                                                            {{ session()->get('session_order')['customer_state'] }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">
                                                    <select class="form-control js-city" name="city" data-type="bill"
                                                        id="billCity" required="">
                                                        <option
                                                            value="{{ session()->get('session_order')['customer_city_id'] }}">
                                                            {{ session()->get('session_order')['customer_city'] }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-warning" id="checkoutZipError"
                                            style="display:none; background-color: #FFBF39; color: #fff;">
                                            {{__('Invalid Zip Code. Please fill the fields manually!')}}
                                        </div>
                                        <div class="row {{ $digital == 1 ? 'd-none' : '' }}">
                                            <div class="col-lg-12 mt-3">
                                                <input class="styled-checkbox" id="ship-diff-address"
                                                    name="diff_address" type="checkbox" value="value1">
                                                <label for="ship-diff-address">{{ __("Ship to a Different Address?")
                                                    }}</label>
                                            </div>
                                        </div>
                                        <div class="ship-diff-addres-area d-none">
                                            <h5 class="title">
                                                {{ __("Shipping Details") }}
                                            </h5>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input class="form-control ship_input" pattern="^(\S*)\s+(.*)$"
                                                        type="text" name="shipping_name" id="shippingName" title={{
                                                        __("Input first name and last name") }} placeholder="{{ __("
                                                        Full Name") }} *"
                                                        value="{{ session()->get('session_order')['shipping_name'] }}">
                                                </div>
                                                @if($gs->is_zip_validation)
                                                <div class="col-lg-6">
                                                    <input class="form-control js-zipcode" type="text"
                                                        name="shipping_zip" data-type="shipping" id="shippingZip"
                                                        placeholder="{{ __(" Postal Code") }}">
                                                </div>
                                                @else
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="shipping_zip"
                                                        data-type="shipping" id="zip" placeholder="{{ __(" Postal Code")
                                                        }}">
                                                </div>
                                                @endif
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="shipping_phone"
                                                        id="shippingPhone" placeholder="{{ __(" Phone Number") }}"
                                                        value="{{ session()->get('session_order')['shipping_phone'] }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="shipping_address"
                                                        id="shippingAddress" placeholder="{{ __(" Address") }}"
                                                        value="{{ session()->get('session_order')['shipping_address'] }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text"
                                                        name="shipping_address_number" id="shippingAddressNumber"
                                                        placeholder="{{ __('Number') }}"
                                                        value="{{ session()->get('session_order')['shipping_address_number'] }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="shipping_complement"
                                                        id="shippingComplement" placeholder="{{ __('Complement') }}"
                                                        value="{{ session()->get('session_order')['shipping_complement'] }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="shipping_district"
                                                        id="shippingDistrict" placeholder="{{ __('District') }}"
                                                        value="{{ session()->get('session_order')['shipping_district'] }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <select class="form-control js-country" name="shipping_country"
                                                        data-type="shipping" id="shippingCountry">
                                                        <option value="" data-code="">{{__('Select Country')}}</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}"
                                                            data-code="{{$country->country_code}}">
                                                            {{$country->country_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select class="form-control js-state" name="shipping_state"
                                                        data-type="shipping" id="shippingState" readonly>
                                                        <option value="">{{__('Select country first')}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select class="form-control js-city" name="shipping_city"
                                                        data-type="shipping" id="shippingCity" readonly>
                                                        <option value="">{{__('Select state first')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="alert alert-warning" id="shippingZipError"
                                                style="display:none; background-color: #FFBF39; color: #fff;">
                                                {{__('Invalid Zip Code, fill the fields manually!')}}
                                            </div>
                                        </div>
                                        @else

                                        <!-- SE NÃO TEM DADOS DA SESSÃO -->
                                        <!-- SE O CADASTRO ESTIVER INCOMPLETO (CIDADE ESTADO E PAÍS PREENCHE COM BASE NO CEP) HABILITA UM BOTÃO QUE REDIRECIONA PARA A RODA EDIT USER -->
                                        @if(Auth::check())
                                        @if(Auth::user()->zip == null || Auth::user()->document == null ||
                                        Auth::user()->address == null || Auth::user()->address_number == null ||
                                        Auth::user()->phone == null )
                                        <a href="{{ route(" user-profile") }}"><span
                                                class="badge badge-primary-checkout">{{ __("Complete your profile
                                                information") }}</span></a>
                                        @endif
                                        @endif
                                        <div class="billing-address">
                                            <!-- CLASSE INSERIDA APENAS PARA FORMATAÇÃO DOS CAMPOS NO FORM -->
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" pattern="^(\S*)\s+(.*)$" id="personal-name"
                                                        class="form-control" name="personal_name" title="{{ __(" Input
                                                        first name and last name") }}" placeholder="{{ __(" Full Name")
                                                        }}"
                                                        value="{{ Auth::check() ? Auth::user()->name : old('personal_name') }}"
                                                        {!! Auth::check() ? 'readonly' : '' !!}>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="email" id="personal-email" class="form-control"
                                                        name="personal_email" placeholder="{{ __(" Enter Your Email")
                                                        }}"
                                                        value="{{ Auth::check() ? Auth::user()->email : old('personal_email') }}"
                                                        {!! Auth::check() ? 'readonly' : '' !!}>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!Auth::check())
                                        <div class="row">
                                            <div class="col-lg-12 mt-3">
                                                <input class="styled-checkbox" id="open-pass" type="checkbox" value="1"
                                                    name="pass_check">
                                                <label for="open-pass">{{ __("Create an account ?") }}</label>
                                            </div>
                                        </div>
                                        <div class="row set-account-pass d-none">
                                            <div class="col-lg-6">
                                                <input type="password" name="personal_pass" id="personal-pass"
                                                    class="form-control" placeholder="{{ __(" Enter Your Password") }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="password" name="personal_confirm"
                                                    id="personal-pass-confirm" class="form-control" placeholder="{{ __("
                                                    Confirm Your Password") }}">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="billing-address">
                                        <h5 class="title">
                                            {{ __("Billing Details") }}
                                        </h5>
                                        <div class="row">
                                            <div class="col-lg-6 {{ $digital == 1 ? 'd-none' : '' }}">
                                                <select class="form-control" id="shipop" name="shipping" required=""
                                                    style="margin-bottom: 10px;">
                                                    <option value="shipto">{{ __("Ship To Address") }}</option>
                                                    <option value="pickup">{{ __("Pick Up") }}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 d-none" id="shipshow">
                                                <select class="form-control" name="pickup_location"
                                                    style="margin-bottom: 10px;">
                                                    @foreach($pickups as $pickup)
                                                    <option value="{{$pickup->location}}">{{$pickup->location}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="name" id="billName"
                                                    placeholder="{{ __(" Full Name") }} *" required=""
                                                    pattern="^(\S*)\s+(.*)$" title="{{ __(" Input first name and last
                                                    name") }}"
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->name : old('name') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="customer_document"
                                                    id="billCpf" placeholder="{{ $customer_doc_str }} *" required=""
                                                    pattern="[0-9]+" title="{{ __(" Field only accepts numbers") }}"
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->document : old('customer_document') }}">
                                            </div>
                                            @if($gs->is_zip_validation)
                                            @if(empty($state_id && $city_id && $country_id))
                                            <div class="col-lg-6">
                                                <input class="form-control js-zipcode" type="text" name="zip"
                                                    data-type="bill" id="billZip" placeholder="{{ __(" Postal Code") }}
                                                    *" required="" value="{{ old('zip') }}">
                                            </div>
                                            @else
                                            <div class="col-lg-6">
                                                <input class="form-control js-zipcode" type="text" name="zip"
                                                    data-type="bill" id="billZip" placeholder="{{ __(" Postal Code") }}
                                                    *" required=""
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->zip : old('zip') }}">
                                            </div>
                                            @endif
                                            @else
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="zip" data-type="bill"
                                                    id="zip" placeholder="{{ __(" Postal Code") }} *" required=""
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->zip : old('zip') }}">
                                            </div>
                                            @endif
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="phone" id="billPhone"
                                                    placeholder="{{ __(" Phone Number") }} *" required=""
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->phone : old('phone') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="email" id="billEmail"
                                                    placeholder="{{ __(" Email") }} *" required=""
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->email : old('email') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="address" id="billAddress"
                                                    placeholder="{{ __(" Address") }} *" required=""
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->address : old('address') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="address_number"
                                                    id="billAdressNumber" placeholder="{{ __('Number') }} *" required=""
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->address_number : old('address_number') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="complement"
                                                    id="billComplement" placeholder="{{ __('Complement') }}"
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->complement : old('complement') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="district"
                                                    id="billDistrict" placeholder="{{ __('District') }}"
                                                    value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->district : old('district') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control js-country" name="country" id="billCountry"
                                                    data-type="bill" required="">
                                                    <option value="" data-code="">{{__('Select Country')}} *</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" {{ (Auth::guard('web')->check()
                                                        && Auth::guard('web')->user()->country_id == $country->id) ?
                                                        'selected' : '' }}
                                                        data-code="{{$country->country_code}}">
                                                        {{ $country->country_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if(Auth::guard('web')->check())
                                            <div class="col-lg-6">
                                                <select class="form-control js-state" name="state" id="billState"
                                                    data-type="bill" required="" readonly>
                                                    <option value="{{ $state_id ?? '' }}"> {{ $state_name }}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control js-city" name="city" id="billCity"
                                                    data-type="bill" required="" readonly>
                                                    <option value="{{ $city_id }}"> {{ $city_name }}</option>
                                                </select>
                                            </div>
                                            @else
                                            <div class="col-lg-6">
                                                <select class="form-control js-state" name="state" id="billState"
                                                    required readonly>
                                                    <option value="">{{__('Select country first')}}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control js-city" name="city" id="billCity" required
                                                    readonly>
                                                    <option value="">{{__('Select state first')}}</option>
                                                </select>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="alert alert-warning" id="checkoutZipError"
                                        style="display:none; background-color: #FFBF39; color: #fff;">
                                        {{__('Invalid Zip Code. Please fill the fields manually!')}}
                                    </div>
                                    <div class="row {{ $digital == 1 ? 'd-none' : '' }}">
                                        <div class="col-lg-12 mt-3">
                                            <input class="styled-checkbox" id="ship-diff-address" name="diff_address"
                                                type="checkbox" value="value1">
                                            <label for="ship-diff-address">{{ __("Ship to a Different Address?")
                                                }}</label>
                                        </div>
                                    </div>
                                    <div class="ship-diff-addres-area d-none">
                                        <h5 class="title">
                                            {{ __("Shipping Details") }}
                                        </h5>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input class="form-control ship_input" pattern="^(\S*)\s+(.*)$"
                                                    type="text" name="shipping_name" id="shippingName" title="{{ __("
                                                    Input first name and last name")}}" placeholder="{{ __(" Full Name")
                                                    }} *">
                                                <input type="hidden" name="shipping_email"
                                                    value="{{ old('shipping_name') }}">
                                            </div>
                                            @if($gs->is_zip_validation)
                                            <div class="col-lg-6">
                                                <input class="form-control js-zipcode" type="text" name="shipping_zip"
                                                    data-type="shipping" id="shippingZip" placeholder="{{ __(" Postal
                                                    Code") }} *" value="{{ old('shipping_zip') }}">
                                            </div>
                                            @else
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="shipping_zip"
                                                    data-type="shipping" id="shippingZip" placeholder="{{ __(" Postal
                                                    Code") }}" value="{{ old('shipping_zip') }}">
                                            </div>
                                            @endif
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="shipping_phone"
                                                    id="shippingPhone" placeholder="{{ __(" Phone Number") }} *"
                                                    value="{{ old('shipping_phone') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="shipping_address"
                                                    id="shippingAddress" placeholder="{{ __(" Address") }} *"
                                                    value="{{ old('shipping_address') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="shipping_address_number"
                                                    id="shippingAddressNumber" placeholder="{{ __('Number') }} *"
                                                    value="{{ old('shipping_address_number') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="shipping_complement"
                                                    id="shippingComplement" placeholder="{{ __('Complement') }} *"
                                                    value="{{ old('shipping_complement') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" type="text" name="shipping_district"
                                                    id="shippingDistrict" placeholder="{{ __('District') }}"
                                                    value="{{ old('shipping_complement') }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control js-country" name="shipping_country"
                                                    data-type="shipping" id="shippingCountry">
                                                    <option value="" data-code="">{{__('Select Country')}}</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->id}}"
                                                        data-code="{{$country->country_code}}">
                                                        {{$country->country_name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control js-state" name="shipping_state"
                                                    data-type="shipping" id="shippingState" readonly>
                                                    <option value="">{{__('Select country first')}}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control  js-city" name="shipping_city"
                                                    data-type="shipping" id="shippingCity" readonly>
                                                    <option value="">{{__('Select state first')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="alert alert-warning" id="shippingZipError"
                                            style="display:none; background-color: #FFBF39; color: #fff;">
                                            {{__('Invalid Zip Code, fill the fields manually!')}}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="order-note mt-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="text" id="Order_Note" class="form-control"
                                                    name="order_note" placeholder="{{ __(" Order Note") }} ({{
                                                    __("Optional") }})" value="{{ old('order_note')  }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12  mt-3">
                                            <p><small>* {{ __("indicates a required field") }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-step2" role="tabpanel" aria-labelledby="pills-step2-tab">
                            <div class="content-box">
                                <div class="content">
                                    @if(env("ENABLE_CUSTOMER_MESSAGE"))
                                    <div class="content alert  alert-warning" role="alert">
                                        <i class="icofont-exclamation-tringle"></i>
                                        {{ __('Consult with Seller')}}
                                    </div>
                                    @endif
                                    <div class="order-area">
                                        @foreach($products as $product)
                                        <div class="order-item">
                                            <div class="product-img">
                                                <div class="d-flex">
                                                    <img src="{{ filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ? $product['item']['photo'] :
                                asset('storage/images/products/'.$product['item']['photo']) }}" alt="product"
                                                        height="80" width="80" class="p-1">
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <p class="name"><a
                                                        href="{{ route('front.product', $product['item']['slug']) }}"
                                                        target="_blank">{{ $product['item']->name }}</a></p>
                                                <div class="unit-price">
                                                    <h5 class="label">{{ __("Price") }} : </h5>
                                                    <p>{{ App\Models\Product::convertPrice($product['item']['price']) }}
                                                    </p>
                                                </div>
                                                @if(!empty($product['size']))
                                                <div class="unit-price">
                                                    <h5 class="label">{{ __("Size") }} : </h5>
                                                    <p>{{ str_replace('-',' ',$product['size']) }}</p>
                                                </div>
                                                @endif

                                                @if(env("ENABLE_CUSTOM_PRODUCT") || env("ENABLE_CUSTOM_PRODUCT_NUMBER"))
                                                @if(!empty($product['customizable_name']))
                                                <div class="unit-price">
                                                    <h5 class="label">{{ __('Custom Name') }} : </h5>
                                                    <p>{{$product['customizable_name']}}</p>
                                                </div>
                                                @endif
                                                @endif

                                                @if(env("ENABLE_CUSTOM_PRODUCT"))
                                                @if(!empty($product['customizable_gallery']))
                                                <div class="unit-price" style="margin-top: 5px;">
                                                    <h5 class="label">{{ __("Photo") }} : </h5>
                                                    <img src="{{ asset('storage/images/galleries/' . $product['customizable_gallery']) }}"
                                                        style="width: 33px; border-radius: 30px; margin-left: 5px; margin-top: -9px; "></img>
                                                </div>
                                                @endif

                                                @if(!empty($product['customizable_logo']))
                                                <div class="unit-price" style="margin-top: 15px; margin-bottom: 5px;">
                                                    <h5 class="label">{{ __("Logo") }} : </h5>
                                                    <img src="{{ asset('storage/images/custom-logo/' . $product['customizable_logo']) }}"
                                                        style="width: 33px; margin-left: 5px; margin-top: -9px; "></img>
                                                </div>
                                                @endif
                                                @endif

                                                @if(env("ENABLE_CUSTOM_PRODUCT_NUMBER"))
                                                @if(!empty($product['customizable_number']))
                                                <div class="unit-price">
                                                    <h5 class="label">{{ __('Custom Number') }} : </h5>
                                                    <p>{{$product['customizable_number']}}</p>
                                                </div>
                                                @endif
                                                @endif

                                                @if(!empty($product['color']))
                                                <div class="unit-price">
                                                    <h5 class="label">{{ __("Color") }} : </h5>
                                                    <span id="color-bar"
                                                        style="border: 10px solid {{$product['color'] == "" ? " white"
                                                        : '#' .$product['color']}};"></span>
                                                </div>
                                                @endif
                                                @if(!empty($product['keys']))
                                                @foreach( array_combine(explode(',', $product['keys']), explode('~',
                                                $product['values'])) as $key => $value)
                                                <div class="quantity">
                                                    <h5 class="label">
                                                        {{ App\Models\Attribute::where('input_name',
                                                        $key)->first()->name }}
                                                        :
                                                    </h5>
                                                    <span class="qttotal">{{ $value }} </span>
                                                </div>
                                                @endforeach
                                                @endif

                                                <div class="quantity">
                                                    <h5 class="label">{{ __("Quantity") }} : </h5>
                                                    <span class="qttotal">{{ $product['qty'] }} </span>
                                                </div>

                                                <div class="total-price">
                                                    <h5 class="label">{{ __("Total Price") }} : </h5>
                                                    <p>{{ App\Models\Product::convertPrice($product['price']) }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-step3" role="tabpanel" aria-labelledby="pills-step3-tab">
                            <div class="content-box">
                                <div class="content">
                                    <div class="billing-info-area {{ $digital == 1 ? 'd-none' : '' }}">
                                        <h4 class="title">
                                            {{ __("Shipping Info") }}
                                        </h4>
                                        <ul class="info-list">
                                            <li>
                                                <p id="final_shipping_user"></p>
                                            </li>
                                            <li>
                                                <p id="final_shipping_location"></p>
                                            </li>
                                            <li>
                                                <p id="final_shipping_zip"></p>
                                            </li>
                                            <li>
                                                <p id="final_shipping_phone"></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="payment-information">
                                        <h4 class="title">
                                            {{ __("Payment Info") }}
                                        </h4>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="nav flex-column" role="tablist" aria-orientation="vertical">
                                                    @if(config("gateways.bancard") && $gs->is_bancard == 1)
                                                    <a class="nav-link payment" data-val="bancard" data-show="yes"
                                                        data-form="{{route('bancard.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'bancard','slug2' => 0]) }}"
                                                        id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1"
                                                        role="tab" aria-controls="v-pills-tab1" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Bancard
                                                            @if($gs->bancard_text != null)
                                                            <small>
                                                                {{ $gs->bancard_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if(config("gateways.cielo") && $gs->is_cielo == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('cielo.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'cielo','slug2' => 0]) }}"
                                                        id="v-pills-tab2-tab" data-toggle="pill" href="#v-pills-tab2"
                                                        role="tab" aria-controls="v-pills-tab2" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Cielo
                                                            @if($gs->cielo_text != null)
                                                            <small>
                                                                {{ $gs->cielo_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if(config("gateways.mercado_pago") && $gs->is_mercadopago == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('mercadopago.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'mercadopago','slug2' => 0]) }}"
                                                        id="v-pills-tab3-tab" data-toggle="pill" href="#v-pills-tab3"
                                                        role="tab" aria-controls="v-pills-tab3" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Mercado Pago
                                                            @if($gs->mercadopago_text != null)
                                                            <small>
                                                                {{ $gs->mercadopago_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if(config("gateways.pagarme") && $gs->is_pagarme == 1)
                                                    <a class="nav-link payment" data-val="pagarme" data-show="no"
                                                        data-form="{{route('pagarme.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'pagarme','slug2' => 0]) }}"
                                                        id="v-pills-tab14-tab" data-toggle="pill" href="#v-pills-tab14"
                                                        role="tab" aria-controls="v-pills-tab14" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Pagarme
                                                            @if($gs->pagarme_text != null)
                                                            <small>
                                                                {{ $gs->pagarme_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if(config("gateways.pagseguro") && $gs->is_pagseguro == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('pagseguro.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'pagseguro','slug2' => 0]) }}"
                                                        id="v-pills-tab12-tab" data-toggle="pill" href="#v-pills-tab12"
                                                        role="tab" aria-controls="v-pills-tab12" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            PagSeguro
                                                            @if($gs->pagseguro_text != null)
                                                            <small>
                                                                {{ $gs->pagseguro_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if(config("gateways.rede") && $gs->is_rede == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('rede.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'rede','slug2' => 0]) }}"
                                                        id="v-pills-tab14-tab" data-toggle="pill" href="#v-pills-tab14"
                                                        role="tab" aria-controls="v-pills-tab14" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Rede
                                                            @if($gs->rede_text != null)
                                                            <small>
                                                                {{ $gs->rede_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if(config("gateways.paghiper") && $gs->is_paghiper == 1 &&
                                                    Session::get("cart")->totalPrice >= 3)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('paghiper.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'paghiper','slug2' => 0]) }}"
                                                        id="v-pills-tab14-tab" data-toggle="pill" href="#v-pills-tab14"
                                                        role="tab" aria-controls="v-pills-tab14" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            @if($gs->paghiper_is_discount)
                                                            {{__("Bank Slip")}} (PagHiper) - {{ $gs->paghiper_discount
                                                            }}% {{__("of discount on the amount of the ticket.")}}
                                                            @else
                                                            {{__("Bank slip")}} (PagHiper)
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif

                                                    @if(config("gateways.paghiper_pix") && $gs->is_paghiper_pix == 1 &&
                                                    Session::get("cart")->totalPrice >= 3)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('paghiper.pix-submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'paghiper-pix','slug2' => 0]) }}"
                                                        id="v-pills-tab14-tab" data-toggle="pill" href="#v-pills-tab14"
                                                        role="tab" aria-controls="v-pills-tab14" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            @if($gs->paghiper_pix_is_discount &&
                                                            $gs->paghiper_pix_discount > 0)
                                                            {{__("PIX")}} (PagHiper) - {{ $gs->paghiper_pix_discount }}%
                                                            {{__("of discount on the amount of the ticket.")}}
                                                            @else
                                                            {{__("PIX")}} (PagHiper)
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif

                                                    @if(config("gateways.pay42") && $gs->is_pay42_pix == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('pay42.pix-submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'pay42-pix','slug2' => 0]) }}"
                                                        id="v-pills-tab14-tab" data-toggle="pill" href="#v-pills-tab14"
                                                        role="tab" aria-controls="v-pills-tab14" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Pay42 pix
                                                            <small>
                                                                {{__('Pay with pay42 pix')}}
                                                            </small>
                                                        </p>
                                                    </a>
                                                    @endif

                                                    @if(config("gateways.pay42") && $gs->is_pay42_billet == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('pay42.billet-submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'pay42-billet','slug2' => 0]) }}"
                                                        id="v-pills-tab14-tab" data-toggle="pill" href="#v-pills-tab14"
                                                        role="tab" aria-controls="v-pills-tab14" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Pay42 billet
                                                            <small>
                                                                {{__('Pay with pay42 billet')}}
                                                            </small>
                                                        </p>
                                                    </a>
                                                    @endif

                                                    @if(config("gateways.pay42") && $gs->is_pay42_card == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('pay42.card-submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'pay42-card','slug2' => 0]) }}"
                                                        id="v-pills-tab14-tab" data-toggle="pill" href="#v-pills-tab14"
                                                        role="tab" aria-controls="v-pills-tab14" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Pay42 card
                                                            <small>
                                                                {{__('Pay with pay42 card')}}
                                                            </small>
                                                        </p>
                                                    </a>
                                                    @endif

                                                    @if(config("gateways.pagopar") && $gs->is_pagopar == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('pagopar.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'pagopar','slug2' => 0]) }}"
                                                        id="v-pills-tab12-tab" data-toggle="pill" href="#v-pills-tab12"
                                                        role="tab" aria-controls="v-pills-tab12" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Pagopar
                                                            @if($gs->pagopar_text != null)
                                                            <small>
                                                                {{ $gs->pagopar_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if(config("gateways.paypal") && $gs->is_paypal == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('paypal.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'paypal','slug2' => 0]) }}"
                                                        id="v-pills-tab4-tab" data-toggle="pill" href="#v-pills-tab4"
                                                        role="tab" aria-controls="v-pills-tab4" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("PayPal Express") }}
                                                            @if($gs->paypal_text != null)
                                                            <small>
                                                                {{ $gs->paypal_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($gs->stripe_check == 1)
                                                    <a class="nav-link payment" data-val="" data-show="yes"
                                                        data-form="{{route('stripe.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'stripe','slug2' => 0]) }}"
                                                        id="v-pills-tab5-tab" data-toggle="pill" href="#v-pills-tab5"
                                                        role="tab" aria-controls="v-pills-tab5" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Credit Card") }}
                                                            @if($gs->stripe_text != null)
                                                            <small>
                                                                {{ $gs->stripe_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($gs->cod_check == 1)
                                                    @if($digital == 0)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('cash.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'cod','slug2' => 0]) }}"
                                                        id="v-pills-tab6-tab" data-toggle="pill" href="#v-pills-tab6"
                                                        role="tab" aria-controls="v-pills-tab6" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Cash On Delivery") }}
                                                            @if($gs->cod_text != null)
                                                            <small>
                                                                {{ $gs->cod_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @endif
                                                    @if($gs->bank_check == 1 && $bank_accounts->isNotEmpty())
                                                    @if($digital == 0)
                                                    <a class="nav-link payment" data-val="bankDeposit" data-show="no"
                                                        data-form="{{route('bank.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'cod','slug2' => 0]) }}"
                                                        id="v-pills-tab13-tab" data-toggle="pill" href="#v-pills-tab13"
                                                        role="tab" aria-controls="v-pills-tab13" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Bank Deposit") }}
                                                            @if($gs->bank_text != null)
                                                            <small>
                                                                {{ $gs->bank_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    <div class="container" id="teste"
                                                        style="margin-top: 10px; font-size: x-medium;">
                                                        @foreach($bank_accounts as $bank_account)
                                                        <ul class="list-group" style="margin-top: 10px">
                                                            <li class="list-group-item" style="padding: 5px;">
                                                                {{strtoupper($bank_account->name)}}</li>
                                                            <li class="list-group-item">{!!nl2br(str_replace(" ",
                                                                "&nbsp;", $bank_account->info))!!}</li>
                                                        </ul>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                    @endif
                                                    @if($gs->is_instamojo == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('instamojo.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'instamojo','slug2' => 0]) }}"
                                                        id="v-pills-tab7-tab" data-toggle="pill" href="#v-pills-tab7"
                                                        role="tab" aria-controls="v-pills-tab7" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Instamojo") }}
                                                            @if($gs->instamojo_text != null)
                                                            <small>
                                                                {{ $gs->instamojo_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($gs->is_paytm == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('paytm.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'paytm','slug2' => 0]) }}"
                                                        id="v-pills-tab8-tab" data-toggle="pill" href="#v-pills-tab8"
                                                        role="tab" aria-controls="v-pills-tab8" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Paytm") }}
                                                            @if($gs->paytm_text != null)
                                                            <small>
                                                                {{ $gs->paytm_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($gs->is_razorpay == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('razorpay.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'razorpay','slug2' => 0]) }}"
                                                        id="v-pills-tab9-tab" data-toggle="pill" href="#v-pills-tab9"
                                                        role="tab" aria-controls="v-pills-tab9" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Razorpay") }}
                                                            @if($gs->razorpay_text != null)
                                                            <small>
                                                                {{ $gs->razorpay_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($gs->is_paystack == 1)
                                                    <a class="nav-link payment" data-val="paystack" data-show="no"
                                                        data-form="{{route('paystack.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'paystack','slug2' => 0]) }}"
                                                        id="v-pills-tab10-tab" data-toggle="pill" href="#v-pills-tab10"
                                                        role="tab" aria-controls="v-pills-tab10" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Paystack") }}
                                                            @if($gs->paystack_text != null)
                                                            <small>
                                                                {{ $gs->paystack_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($gs->is_molly == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no"
                                                        data-form="{{route('molly.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'molly','slug2' => 0]) }}"
                                                        id="v-pills-tab11-tab" data-toggle="pill" href="#v-pills-tab11"
                                                        role="tab" aria-controls="v-pills-tab11" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ __("Mollie Payment") }}
                                                            @if($gs->molly_text != null)
                                                            <small>
                                                                {{ $gs->molly_text }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($digital == 0)
                                                    @foreach($gateways as $gt)
                                                    <a class="nav-link payment" data-val="" data-show="yes"
                                                        data-form="{{route('gateway.submit')}}"
                                                        data-href="{{ route('front.load.payment',['slug1' => 'other','slug2' => $gt->id]) }}"
                                                        id="v-pills-tab{{ $gt->id }}-tab" data-toggle="pill"
                                                        href="#v-pills-tab{{ $gt->id }}" role="tab"
                                                        aria-controls="v-pills-tab{{ $gt->id }}" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ $gt->title }}
                                                            @if($gt->subtitle != null)
                                                            <small>
                                                                {{ $gt->subtitle }}
                                                            </small>
                                                            @endif
                                                        </p>
                                                    </a>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="pay-area d-none">
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        @if(config("gateways.bancard") && $gs->is_bancard == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab1" role="tabpanel"
                                                            aria-labelledby="v-pills-tab1-tab"></div>
                                                        @endif
                                                        @if(config("gateways.cielo") && $gs->is_cielo == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab2" role="tabpanel"
                                                            aria-labelledby="v-pills-tab2-tab"></div>
                                                        @endif
                                                        @if(config("gateways.mercado_pago") && $gs->is_mercadopago
                                                        == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab3" role="tabpanel"
                                                            aria-labelledby="v-pills-tab3-tab"></div>
                                                        @endif

                                                        <div class="tab-pane fade" id="v-pills-tab14" role="tabpanel"
                                                            aria-labelledby="v-pills-tab14-tab"></div>

                                                        @if(config("gateways.pagseguro") && $gs->is_pagseguro == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab12" role="tabpanel"
                                                            aria-labelledby="v-pills-tab12-tab">
                                                        </div>
                                                        @endif
                                                        {{-- @if(config("gateways.cielo") && $gs->is_cielo == 1) --}}
                                                        <div class="tab-pane fade" id="v-pills-tab14" role="tabpanel"
                                                            aria-labelledby="v-pills-tab14-tab"></div>
                                                        {{-- @endif --}}
                                                        @if($gs->paypal_check == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab4" role="tabpanel"
                                                            aria-labelledby="v-pills-tab4-tab"></div>
                                                        @endif
                                                        @if($gs->stripe_check == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab5" role="tabpanel"
                                                            aria-labelledby="v-pills-tab5-tab"></div>
                                                        @endif
                                                        @if($gs->cod_check == 1)
                                                        @if($digital == 0)
                                                        <div class="tab-pane fade" id="v-pills-tab6" role="tabpanel"
                                                            aria-labelledby="v-pills-tab6-tab"></div>
                                                        @endif
                                                        @endif
                                                        @if($gs->bank_check == 1)
                                                        @if($digital == 0)
                                                        <div class="tab-pane fade" id="v-pills-tab13" role="tabpanel"
                                                            aria-labelledby="v-pills-tab13-tab">
                                                        </div>
                                                        @endif
                                                        @endif
                                                        @if($gs->is_instamojo == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab7" role="tabpanel"
                                                            aria-labelledby="v-pills-tab7-tab"></div>
                                                        @endif
                                                        @if($gs->is_paytm == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab8" role="tabpanel"
                                                            aria-labelledby="v-pills-tab8-tab"></div>
                                                        @endif
                                                        @if($gs->is_razorpay == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab9" role="tabpanel"
                                                            aria-labelledby="v-pills-tab9-tab"></div>
                                                        @endif
                                                        @if($gs->is_paystack == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab10" role="tabpanel"
                                                            aria-labelledby="v-pills-tab10-tab">
                                                        </div>
                                                        @endif
                                                        @if($gs->is_molly == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab11" role="tabpanel"
                                                            aria-labelledby="v-pills-tab11-tab">
                                                        </div>
                                                        @endif
                                                        @if($digital == 0)
                                                        @foreach($gateways as $gt)
                                                        <div class="tab-pane fade" id="v-pills-tab{{ $gt->id }}"
                                                            role="tabpanel"
                                                            aria-labelledby="v-pills-tab{{ $gt->id }}-tab"></div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <input type="hidden" data-type="punto" id="punto-selected" class="puntocontroller" name="puntoentrega"
                value="">
            <input type="hidden" id="punto-id" class="puntoid" name="puntoidvalue" value="">
            <input type="hidden" id="aex-city" name="aex_city" value="0">
            <input type="hidden" id="shipping-cost" name="shipping_cost" value="0">
            <input type="hidden" id="packing-cost" name="packing_cost" value="0">
            <input type="hidden" name="dp" value="{{$digital}}">
            <input type="hidden" name="tax" value="{{$gs->tax}}">
            <input type="hidden" name="totalQty" value="{{$totalQty}}">
            <input type="hidden" name="vendor_shipping_id" value="{{ $vendor_shipping_id }}">
            <input type="hidden" name="vendor_packing_id" value="{{ $vendor_packing_id }}">
            @if(Session::has('coupon_total'))
            <input type="hidden" name="total" id="grandtotal" value="{{ $totalPrice }}">
            <input type="hidden" id="tgrandtotal" value="{{ $totalPrice }}">
            @elseif(Session::has('coupon_total1'))
            <input type="hidden" name="total" id="grandtotal" value="{{ preg_replace(" /[^0-9,.]/", "" ,
                Session::get('coupon_total1') ) }}">
            <input type="hidden" id="tgrandtotal" value="{{ preg_replace(" /[^0-9,.]/", "" ,
                Session::get('coupon_total1') ) }}">
            @else
            <input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr_checkout->value,2)}}">
            <input type="hidden" id="tgrandtotal" value="{{round($totalPrice * $curr_checkout->value,2)}}">
            @endif
            <input type="hidden" name="coupon_code" id="coupon_code"
                value="{{ Session::has('coupon_code') ? Session::get('coupon_code') : '' }}">
            <input type="hidden" name="coupon_discount" id="coupon_discount"
                value="{{ Session::has('coupon') ? Session::get('coupon') : '' }}">
            <input type="hidden" name="coupon_id" id="coupon_id"
                value="{{ Session::has('coupon') ? Session::get('coupon_id') : '' }}">
            <input type="hidden" name="user_id" id="user_id"
                value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">
            </form>
        </div>
        @if(Session::has('cart'))
        <div class="col-lg-4">
            <div class="right-area">
                <div class="order-box">
                    <h4 class="title">{{ __("PRICE DETAILS") }}</h4>
                    <ul class="order-list">
                        <li>
                            <p>
                                {{ __("Total MRP") }}
                            </p>
                            <P>
                                <b class="cart-total">{{ Session::has('cart') ?
                                    App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</b>
                            </P>
                        </li>
                        @if($gs->tax != 0)
                        <li>
                            <p>
                                {{ __("Tax") }}
                            </p>
                            <P>
                                <b> {{$gs->tax}}% </b>
                            </P>
                        </li>
                        @endif
                        @if(Session::has('coupon'))
                        <li class="discount-bar">
                            <p>
                                {{ __("Discount") }} <span class="dpercent">{{ Session::get('coupon_percentage') == 0 ?
                                    '' : '('.Session::get('coupon_percentage').')' }}</span>
                            </p>
                            <P>
                                @if($gs->currency_format == 0)
                                <b id="discount">{{ $curr_checkout->sign }}{{ number_format(Session::get('coupon'),
                                    $curr_checkout->decimal_digits,
                                    $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}</b>
                                @else
                                <b id="discount">{{ number_format(Session::get('coupon'),
                                    $curr_checkout->decimal_digits,
                                    $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}{{
                                    $curr_checkout->sign }}</b>
                                @endif
                            </P>
                        </li>
                        @else
                        <li class="discount-bar d-none">
                            <p>
                                {{ __("Discount") }} <span class="dpercent"></span>
                            </p>
                            <P>
                                <b id="discount">{{ $curr_checkout->sign }}{{ number_format(Session::get('coupon'),
                                    $curr_checkout->decimal_digits,
                                    $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}</b>
                            </P>
                        </li>
                        @endif
                    </ul>
                    <div class="total-price">
                        <p style="margin-bottom:0px;">
                            {{ __("Total") }}
                        </p>
                        <p style="margin-bottom:0px;">
                            @if(Session::has('coupon_total'))
                            @if($gs->currency_format == 0)
                            <span id="total-cost">{{ $curr_checkout->sign }}{{ number_format($totalPrice,
                                $curr_checkout->decimal_digits,
                                $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}</span>
                            @else
                            <span id="total-cost">{{ number_format($totalPrice, $curr_checkout->decimal_digits,
                                $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}{{
                                $curr_checkout->sign }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="total-price">
                        <p></p>
                        <p>
                            <span id="total-cost2">{{ App\Models\Product::convertPriceReverse($totalPrice) }}</span>
                            @elseif(Session::has('coupon_total1'))
                            @if($gs->currency_format == 0)
                            <span id="total-cost">{{ $curr_checkout->sign }}{{
                                number_format(Session::get('coupon_total1'), $curr_checkout->decimal_digits,
                                $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}</span>
                            @else
                            <span id="total-cost">{{ number_format(Session::get('coupon_total1'),
                                $curr_checkout->decimal_digits,
                                $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}{{
                                $curr_checkout->sign }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="total-price">
                        <p></p>
                        <p>
                            <span id="total-cost2">{{
                                App\Models\Product::convertPriceReverse(Session::get('coupon_total1')) }}</span>
                            @else
                            <span id="total-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
                        </p>
                    </div>
                    <div class="total-price">
                        <p></p>
                        <p>
                            <span id="total-cost2">{{ App\Models\Product::signFirstPrice($totalPrice) }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="cupon-box">
                        <div id="coupon-link">
                            <img src="{{ asset('assets/images/tag.png') }}">
                            {{ __("Have a promotion code?") }}
                        </div>
                        <form id="check-coupon-form" class="coupon">
                            <input type="text" placeholder="{{ __(" Coupon Code") }} *" id="code" required=""
                                autocomplete="off">
                            <button type="submit">{{ __("Apply") }}</button>
                        </form>
                    </div>
                    @if($digital == 0)
                    {{-- Shipping Method Area Start --}}
                    <div class="shipping-area-class" id="shipping-area">
                        <h4 class="title">{{ __("Shipping Method") }}</h4>
                        <p id="empty-ship">{{ __('Input Address') }}</p>
                        <p id="pickup-ship" class="d-none">{{ __('Pickup') }}</p>
                    </div>

                    @if($gs->is_aex && config("features.aex_shipping"))
                    <div id="aex-box">
                        <div class="alert alert-info">
                            <small>{{ __('Please select location bellow to show AEX Shipping option')}}</small>
                        </div>
                        <form id="freight-form-aex" class="coupon">
                            <select class="form-control" id="aex_destination" name="aex_destination">
                                <option value="">{{ __('Select City') }}</option>
                                @foreach($aex_cities as $city)
                                <option value="{{ $city->codigo_ciudad }}">{{$city->denominacion}} -
                                    {{$city->departamento_denominacion}}</option>
                                @endforeach
                            </select>
                            <div class="shipping-area-class text-left mt-4" id="shipping-area-aex"></div>
                        </form>
                    </div>
                    @endif

                    {{-- Shipping Method Area End --}}
                    {{-- Packeging Area Start --}}
                    <div class="packeging-area">
                        <h4 class="title">{{ __("Packaging") }}</h4>
                        @foreach($package_data as $data)
                        <div class="radio-design">
                            <input type="radio" class="packing" id="free-package{{ $data->id }}" name="packeging"
                                data-price="{{ $data->price * $curr_checkout->value }}" data-id="{{ $data->id }}"
                                value="{{ $data->id }}" {{ ($loop->first) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <label for="free-package{{ $data->id }}">
                                {{ $data->title }}
                                @if($data->price != 0)
                                +
                                {{ $curr_checkout->sign }}{{ number_format($data->price * $curr_checkout->value,
                                $curr_checkout->decimal_digits,
                                $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}
                                @endif
                                <small>{{ $data->subtitle }}</small>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    {{-- Packeging Area End Start--}}
                    {{-- Final Price Area Start--}}
                    <div class="final-price">
                        <span>{{ __("Final Price") }} :</span>
                        @if(Session::has('coupon_total'))
                        @if($gs->currency_format == 0)
                        <span id="final-cost">{{ $curr_checkout->sign }}{{ number_format($totalPrice,
                            $curr_checkout->decimal_digits,
                            $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}</span>
                        @else
                        <span id="final-cost">{{ number_format($totalPrice, $curr_checkout->decimal_digits,
                            $curr_checkout->decimal_separator,$curr_checkout->thousands_separator) }}{{
                            $curr_checkout->sign }}</span>
                        @endif
                    </div>
                    <div class="total-price">
                        <span></span>
                        <span id="final-cost2">{{ App\Models\Product::signFirstPrice($totalPrice) }}</span>
                        @elseif(Session::has('coupon_total1'))
                        <span id="final-cost"> {{ Session::get('coupon_total1') }}</span>
                    </div>
                    <div class="total-price">
                        <span></span>
                        <span id="final-cost2">{{ App\Models\Product::convertPriceReverse(Session::get('coupon_total1'))
                            }}</span>
                        @else
                        <span id="final-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
                    </div>
                    <div class="total-price">
                        <span></span>
                        <span id="final-cost2">{{ App\Models\Product::signFirstPrice($totalPrice) }}</span>
                        @endif
                    </div>
                    {{-- Final Price Area End --}}
                    @endif
                    {{-- <a href="{{ route('front.checkout') }}" class="order-btn mt-4">
                        {{ __("Place Order") }}
                    </a> --}}
                    <div class="row" id="buttons1">
                        <div class="col-lg-12  mt-3">
                            <div class="bottom-area paystack-area-btn button1">
                                <button type="submit" class="mybtn1 fbPaymentInfo" onclick="scrolltotop()" id="button1"
                                    form="myform">{{ __("Continue") }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="row none" id="buttons2">
                        <div class="col-lg-12 mt-3 center-buttons">
                            <div class="bottom-area">
                                <a href="javascript:;" onclick="back1();scrolltotop()" id="step1-btn"
                                    class="mybtn1 mr-3" form="myform">{{ __("Back") }}</a>
                                <button href="javascript:;" onclick="continue2();scrolltotop()" id="step3-btn"
                                    class="mybtn1">{{ __("Continue") }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="row none" id="buttons3">
                        <div class="col-lg-12 mt-3">

                            <div class="alert alert-danger validation alert-ajax" style="display:none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <p class="left-text">x</p>
                            </div>

                            <div class="bottom-area center-buttons">
                                <a href="javascript:;" onclick="back2();scrolltotop()" id="step2-btn"
                                    class="mybtn1 mr-3" form="myform">{{ __("Back") }}</a>
                                <button type="submit" id="final-btn" class="mybtn1" form="myform">{{ __("Continue")
                                    }}</button>
                            </div>
                        </div>
                    </div>
                    @if($gs->is_simplified_checkout && $gs->simplified_checkout_number)
                    <a href="#" id="whatsapp-modal" class="order-btn mt-2 d-none" data-toggle="modal"
                        data-target="#simplified-checkout-modal">{{ __("Simplified Checkout") }}</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
</section>
<!-- Check Out Area End-->
@if($checked)
<!-- LOGIN MODAL -->
<div class="modal fade" id="comment-log-reg1" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="comment-log-reg-Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close">
                    <a href="{{ url()->previous() }}"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body">
                <nav class="comment-log-reg-tabmenu">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link login active" id="nav-log-tab" data-toggle="tab" href="#nav-log"
                            role="tab" aria-controls="nav-log" aria-selected="true">
                            {{ __("Login") }}
                        </a>
                        <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab"
                            aria-controls="nav-reg" aria-selected="false">
                            {{ __("Register") }}
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
                        <div class="login-area">
                            <div class="header-area">
                                <h4 class="title">{{ __("LOGIN NOW") }}</h4>
                            </div>
                            <div class="login-form signin-form">
                                @include('includes.admin.form-login')
                                <form id="loginform" action="{{ route('user.login.submit') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-input">
                                        <input type="email" name="email" placeholder="{{ __(" Type Email Address") }} *"
                                            required="">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="password" class="Password" name="password" placeholder="{{ __("
                                            Type Password") }} *" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>
                                    <div class="form-forgot-pass">
                                        <div class="left">
                                            <input type="hidden" name="modal" value="1">
                                            <input type="checkbox" name="remember" id="mrp" {{ old('remember')
                                                ? 'checked' : '' }}>
                                            <label for="mrp">{{ __("Remember Password") }}</label>
                                        </div>
                                        <div class="right">
                                            <a href="{{ route('user-forgot') }}">
                                                {{ __("Forgot Password?") }}
                                            </a>
                                        </div>
                                    </div>
                                    <input id="authdata" type="hidden" value="{{ __(" Authenticating...") }}">
                                    <button type="submit" class="submit-btn">{{ __("Login") }}</button>
                                    @if(App\Models\Socialsetting::find(1)->f_check == 1 ||
                                    App\Models\Socialsetting::find(1)->g_check == 1)
                                    <div class="social-area">
                                        <h3 class="title">{{ __("Or") }}</h3>
                                        <p class="text">{{ __("Sign In with social media") }}</p>
                                        <ul class="social-links">
                                            @if(App\Models\Socialsetting::find(1)->f_check == 1)
                                            <li>
                                                <a href="{{ route('social-provider','facebook') }}">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            @endif
                                            @if(App\Models\Socialsetting::find(1)->g_check == 1)
                                            <li>
                                                <a href="{{ route('social-provider','google') }}">
                                                    <i class="fab google"></i>
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
                        <div class="login-area signup-area">
                            <div class="header-area">
                                <h4 class="title">{{ __("Signup Now") }}</h4>
                            </div>
                            <div class="login-form signup-form">
                                @include('includes.admin.form-login')
                                <form id="registerform" action="{{route('user-register-submit')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-input">
                                        <input type="text" class="User Name" name="name" title="{{ __(" Input first name
                                            and last name") }}" placeholder="{{ __(" Full Name") }} *" required=""
                                            pattern="^(\S*)\s+(.*)$">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="email" class="User Name" name="email" placeholder="{{ __(" Email
                                            Address") }} *" required="">
                                        <i class="icofont-email"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" class="User Name" name="phone" placeholder="{{ __(" Phone
                                            Number") }} *" required="">
                                        <i class="icofont-phone"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" class="User Name" name="address" placeholder="{{ __("
                                            Address") }} *" required="">
                                        <i class="icofont-location-pin"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="password" class="Password" name="password" placeholder="{{ __("
                                            Password") }} *" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="password" class="Password" name="password_confirmation"
                                            placeholder="{{ __(" Confirm Password") }} *" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>
                                    @if($gs->is_capcha == 1)
                                    <ul class="captcha-area">
                                        <li>
                                            <p><img class="codeimg1" src="{{asset(" storage/images/capcha_code.png")}}"
                                                    alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i></p>
                                        </li>
                                    </ul>
                                    <div class="form-input">
                                        <input type="text" class="Password" name="codes" placeholder="{{ __(" Enter
                                            Code") }} *" required="">
                                        <i class="icofont-refresh"></i>
                                    </div>
                                    @endif
                                    @php
                                    $url = $gs->privacy_policy ? true : false;
                                    @endphp
                                    <div class="form-forgot-pass">
                                        <div class="left">
                                            <input type="checkbox" name="agree_privacy_policy"
                                                id="agree_privacy_policy">
                                            <label for="agree_privacy_policy">Concordo com a <a target="_blank"
                                                    href="{{ $url ? route('front.privacypolicy') : ""  }}">Política de
                                                    Privacidade</a>.</label>
                                        </div>
                                    </div>
                                    <input id="processdata" type="hidden" value="{{ __(" Processing...") }}">
                                    <button type="submit" class="submit-btn">{{ __("Register") }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN MODAL ENDS -->
@endif
<div class="modal fade" id="iframe-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" style="transition: .5s; padding:10px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="iframe-container"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.onload = function () {
        document.getElementById("customer_name").value = document.getElementById("billName").value;
        document.getElementById("customer_phone").value = document.getElementById("billPhone").value;
    }

    var billName = document.getElementById("billName");

    billName.addEventListener("change", function () {
        document.getElementById("customer_name").value = billName.value;
    });

    var billPhone = document.getElementById("billPhone");

    billPhone.addEventListener("change", function () {
        document.getElementById("customer_phone").value = billPhone.value;
    });
</script>

<script>
    // Global variables
  var pos = '{{$gs->currency_format}}';
  var dec_sep = '{{ $curr_checkout->decimal_separator }}';
  var tho_sep = '{{ $curr_checkout->thousands_separator }}';
  var dec_dig = '{{$curr_checkout->decimal_digits}}';
  var dec_sep2 = '{{ $first_curr->decimal_separator }}';
  var tho_sep2 = '{{ $first_curr->thousands_separator }}';
  var dec_dig2 = '{{$first_curr->decimal_digits}}';
  var diff_address = false;
  var checkout_url = '{{ route("front.checkout") }}';
  var fbPaymentInfoClick = false;
  var currency = '{{$curr_checkout->name}}';
  var price = '{{ $totalPrice }}';
    $(document).ready(function(){
        if(typeof fbq != 'undefined'){
            fbq('track', 'InitiateCheckout', {
                value: price,
                currency: currency
            });
        }
    });

    $(".fbPaymentInfo").click(function(){
        if(!fbPaymentInfoClick){
            setTimeout(function(){
                if($("#pills-step2").hasClass("active")){
                    if(typeof fbq != 'undefined'){
                        fbq('track', 'AddPaymentInfo');
                        fbPaymentInfoClick = true;
                    }
                }
            }, 1000);
        }
    });

  // Calculate Shipping and Package in frontend
  function calc_ship_pack() {
    var mship = $('.shipping').length > 0 ? $('.shipping:checked').map(function() {
      return $(this).data('price');
    }).get() : 0;
    var mpack = $('.packing').length > 0 ? $('.packing:checked').map(function() {
      return $(this).data('price');
    }).get() : 0;
    mship = parseFloat(mship);
    mpack = parseFloat(mpack);
    if (isNaN(mship)) {
      mship = 0;
    }
    if (isNaN(mpack)) {
      mpack = 0;
    }
    var shipid = $('.shipping').length > 0 ? $('.shipping:checked').map(function() {
      return $(this).data('id');
    }).get() : 0;
    var packid = $('.packing').length > 0 ? $('.packing:checked').map(function() {
      return $(this).data('id');
    }).get() : 0;
    $('#shipping-cost').val(shipid);
    $('#packing-cost').val(packid);
    $('#aex-city').val($('#aex_destination').val());

    var ftotal = parseFloat($('#grandtotal').val()) + mship + mpack;
    ftotal = parseFloat(ftotal);
    var curr_checkout_value = parseFloat('{{$curr_checkout->value}}');
    var ftotal2 = ftotal / curr_checkout_value;

    if (pos == 0) {
      $('#final-cost').html('{{ $curr_checkout->sign }}' + $.number(ftotal, dec_dig, dec_sep, tho_sep));
      $('#final-cost2').html('{{ $first_curr->sign }}' + $.number(ftotal2, dec_dig2, dec_sep2, tho_sep2));
    } else {
      $('#final-cost').html($.number(ftotal, dec_dig, dec_sep, tho_sep) + '{{ $curr_checkout->sign }}');
      $('#final-cost2').html($.number(ftotal2, dec_dig2, dec_sep2, tho_sep2) + '{{ $first_curr->sign }}');
    }
  }
  // End Calculate Shipping and Package in frontend
</script>
<script>
    function gerarPonto(id) {
        var pontoselecionado = document.querySelector('input[name="puntoentrega"]:checked').value;
        document.getElementById("punto-selected").value = pontoselecionado;

        document.getElementById("punto-id").value = id;
    }

    function excluirPonto(){
        var envioStandard = document.querySelector('input[data-itemtype="standard"]:checked');
        if (envioStandard) {
            var pontos = document.getElementsByName("puntoentrega");
            for(var i=0;i<pontos.length;i++) {
                pontos[i].checked = false;
            }
            document.getElementById("punto-selected").value = null;
            document.getElementById("punto-id").value = null;
        }
    }

  // Create Account checkbox
  $("#open-pass").on("change", function() {
    if (this.checked) {
      $('.set-account-pass').removeClass('d-none');
      $('.set-account-pass input').prop('required', true);
      $('#personal-email').prop('required', true);
      $('#personal-name').prop('required', true);
    } else {
      $('.set-account-pass').addClass('d-none');
      $('.set-account-pass input').prop('required', false);
      $('#personal-email').prop('required', false);
      $('#personal-name').prop('required', false);
    }
  });
  // End Create Account checkbox

  // Pickup and Address shipping select
  $('#shipop').on('change', function() {
      var val = $(this).val();
      if (val == 'pickup') {
          $('#shipshow').removeClass('d-none');
          $("#ship-diff-address").parent().addClass('d-none');
          $("#ship-diff-address").removeAttr('checked');
          $('.ship-diff-addres-area').addClass('d-none');
          $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required', false);
          $('#empty-ship').addClass('d-none');
          $('#pickup-ship').removeClass('d-none');
          $('.normal-sheep').remove();
          $('.PAC-sheep').remove();
          $('.SEDEX-sheep').remove();
          $('.aex-sheep').remove();
          $('#aex-box').addClass('d-none');
          calc_ship_pack();
      } else {
          $('#shipshow').addClass('d-none');
          $("#ship-diff-address").parent().removeClass('d-none');
          $('#empty-ship').removeClass('d-none');
          $('#pickup-ship').addClass('d-none');
          $('#billCity').trigger('change');
          $('#aex-box').removeClass('d-none');
      }
    });
  // End Pickup and Address shipping select

  // Shipping Address Checking
  $("#ship-diff-address").on("change", function() {
    if (this.checked) {
      diff_address = true;
      $('#shippingCity').trigger('change');
      $('.ship-diff-addres-area').removeClass('d-none');
      $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required', true);
    } else {
      diff_address = false;
      $('#billCity').trigger('change');
      $('.ship-diff-addres-area').addClass('d-none');
      $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required', false);
    }
  });
  // End Shipping Address Checking

  // Resets country selection based on logged user and session available
  @if(!Auth::check() && !Session::has('session_order'))
  $('.js-country').val('');
  @endif

  // Reload the page to work with the ajax if there was a session available
  if($('#has_temporder').val() === 'true') {
    $('#has_temporder').val('false');
    window.location = checkout_url;
  }

  // Selecting the country loads the states
  $('.js-country').change(function(e, zipdata) {
    var select_state = 'billState';
    var select_city = 'billCity';

    if($(this).data('type') == 'shipping') {
      select_state = 'shippingState';
      select_city = 'shippingCity';
    }

    $('#preloader_checkout').show();
    $('#checkoutZipError').hide();
    if(!$(this).val()) {
      $('#empty-ship').html('{{ __("Input Address") }}');

      $('#'+select_state).attr('readonly', true);
      $('#'+select_state).html('<option value="">{{__("Select country first")}}</option>');

      $('#'+select_city).attr('readonly', true);
      $('#'+select_city).html('<option value="">{{__("Select state first")}}</option>');

      $('#preloader_checkout').hide();
      return;
    }
    $.ajax({
      type: 'GET',
      url: mainurl + '/checkout/getStatesOptions',
      data: {
        location_id: $(this).val()
      },
      success: function(data) {
        if(zipdata) {
          $('#'+select_state).html('<option value="'+zipdata['state_id']+'">'+zipdata['state_name']+'</option>').trigger('change', zipdata);
        } else {
          $('#'+select_state).html('<option value="">{{__("Select State")}}</option>');
        }
        $('#'+select_state).append(data).removeAttr('readonly');
      },
      error: function (err) {
        console.log(err);
      },
      complete: function () {
        if(!zipdata) {
          $('#preloader_checkout').hide();
        }
      }
    })
  });
  // End Selecting Country

  // Selecting the state loads the cities
  $('.js-state').change(function(e, zipdata) {
    var select_city = 'billCity';

    if($(this).data('type') == 'shipping') {
      select_city = 'shippingCity';
    }

    $('#preloader_checkout').show();
    if(!$(this).val()) {
      $('#empty-ship').html('{{ __("Input Address") }}');

      $('#'+select_city).attr('readonly', true);
      $('#'+select_city).html('<option value="">{{__("Select state first")}}</option>');

      $('#preloader_checkout').hide();
      return;
    }
    $.ajax({
      type: 'GET',
      url: mainurl + '/checkout/getCitiesOptions',
      data: {
        location_id: $(this).val()
      },
      success: function(data) {
        if(zipdata) {
          $('#'+select_city).html('<option value="'+zipdata['city_id']+'">'+zipdata['city']+'</option>').trigger('change');
        } else {
          $('#'+select_city).html('<option value="">{{__("Select City")}}</option>');
        }
        $('#'+select_city).append(data).removeAttr('readonly');
      },
      error: function (err) {
        console.log(err);
      },
      complete: function () {
        if(!zipdata) {
          $('#preloader_checkout').hide();
        }
      }
    })
  });
  // End Selecting State

  // Selecting the City loads available shipping methods
  $('.js-city').change(function() {
    var select_state = 'billState';
    var select_country = 'billCountry';
    var zip_field = 'billZip';

    if($(this).data('type') == 'shipping') {
      select_state = 'shippingState';
      select_country = 'shippingCountry';
      zip_field = 'shippingZip';
    }

    $('#preloader_checkout').show();
    if(!$(this).val()) {
      $('#empty-ship').html('{{ __("Input Address") }}');
      //$('#preloader_checkout').hide();
      //return;
    }
    if ($('#shipop').val() != 'pickup') {
      // calculate shipping methods if method is not pickup
      $.ajax({
        type: 'GET',
        url: mainurl + '/checkout/getShippingsOptions',
        data: {
          city_id: $(this).val(),
          state_id: $('#'+select_state).val(),
          country_id: $('#'+select_country).val(),
          zip_code: $('#'+zip_field).val(),
          codigo_ciudad: $('#aex_destination').val()
        },

        success: function(data) {
          $('#empty-ship').html('');

          $('#button1, .checkout-process').show();
          $('#whatsapp-modal').addClass('d-none');

          if (data.success == false) {
            $('#button1, .checkout-process').hide();
            $('#whatsapp-modal').removeClass('d-none');
          }

          if(data.is_simplified_checkout == false) {
            $('#button1, .checkout-process').hide();
          }

          $('#empty-ship').append(data.content);

          // Calculate new prices when clicking the shipping methods
          $('.shipping').on('click', function() {
              calc_ship_pack();
          });

          $("input:radio[name=shipping]:not(:disabled):first").prop('checked', 'checked');
        },
        error: function (err) {
            $('#step3-btn').on('click', function() {
                $('#whatsapp-modal').addClass('d-none');
            });
            console.log(err);
        },
        complete: function () {
          calc_ship_pack();
          $('#preloader_checkout').hide();
        }
      })
    } else {
      $('#preloader_checkout').hide();
    }
  });
  // End Selecting City

  // Calculate initial prices with first shipping upon loading
  calc_ship_pack();

  // Calculate new prices when clicking the packages available
  $('.packing').on('click', function() {
      calc_ship_pack();
  });

  // Calculate Coupon Discounts if applied
  $('#check-coupon-form').on('submit', function (e) {
    $('#preloader_checkout').show();
    e.preventDefault();
    var val = $('#code').val();
    var total = $('#grandtotal').val();
    var ship = 0;
    $.ajax({
      type: 'GET',
      url: mainurl + '/carts/coupon/check',
      data: {
        code: val,
        total: total,
        shipping_cost: ship
      },
      success: function(data) {
        //Coupon not found
        if(data.not_found) {
          toastr.error(data['not_found']);
          $('#code').val('');
          return;
        }

        //Coupon already applied
        if(data.already) {
          toastr.error(data['already']);
          $('#code').val('');
          return;
        }

        // Display Discount applied
        $('#check-coupon-form').toggle();
        $('.discount-bar').removeClass('d-none');

        // In the following, data is an array with the representation:
        // data[0] = cart total price in store currency
        // data[1] = the coupon code
        // data[2] = the coupon value or percentage
        // data[3] = the coupon ID
        // data[4] = 0 if coupon is a value; the coupon price in percentage
        // data[5] = 1
        // data[6] = cart total price in currency 1

        if (pos == 0) {
            $('#total-cost').html('{{ $curr_checkout->sign }}' + $.number(data[0], dec_dig,
                dec_sep, tho_sep));
            $('#total-cost2').html('{{ $first_curr->sign }}' + $.number(data[6],
                dec_dig2, dec_sep2, tho_sep2));
            $('#discount').html('{{ $curr_checkout->sign }}' + $.number(data[2], dec_dig,
                dec_sep, tho_sep));
        } else {
            $('#total-cost').html($.number(data[0], dec_dig, dec_sep, tho_sep) +
                '{{ $curr_checkout->sign }}');
            $('#total-cost2').html($.number(data[6], dec_dig2, dec_sep2, tho_sep2) +
                '{{ $first_curr->sign }}');
            $('#discount').html($.number(data[2], dec_dig, dec_sep, tho_sep) +
                '{{ $curr_checkout->sign }}');
        }

        $('#grandtotal').val(data[0]);
        $('#tgrandtotal').val(data[0]);
        $('#coupon_code').val(data[1]);
        $('#coupon_discount').val(data[2]);

        if (data[4] != 0) {
            $('.dpercent').html('(' + data[4] + ')');
        } else {
            $('.dpercent').html('');
        }

        toastr.success(data['success']);
        $('#code').val('');
      },
      error: function (err) {
        console.log(err);
      },
      complete: function () {
        calc_ship_pack();
        $('#preloader_checkout').hide();
      }
    })
  });

  // Search address by zipcode
  $('.js-zipcode').on('change', function () {
    var address_field = 'billAddress';
    var district_field = 'billDistrict';
    var select_country = 'billCountry';

    if($(this).data('type') == 'shipping') {
      address_field = 'shippingAddress';
      district_field = 'shippingDistrict';
      select_country = 'shippingCountry';
    }

    $('#preloader_checkout').show();
    $('#checkoutZipError').hide();
    $.ajax({
      type: 'GET',
      url: mainurl + '/checkout/cep',
      data: {
        cep: $(this).val()
      },
      success: function(data) {
        // Invalid zipcode
        if(data.error) {
          $('#checkoutZipError').show();
          $('#preloader_checkout').hide();
          return;
        }

        // Fill address inputs
        $('#'+address_field).val(data['street']);
        $('#'+district_field).val(data['district']);

        //Select country based on the zipcode, passing the zipdata.
        // Then the selects are triggered in sequence, checking the zipdata
        // in each trigger
        $('#'+select_country).val(data['country_id']).trigger('change', data);

      },
      error: function (err) {
        console.log(err);
        $('#preloader_checkout').hide();
      }
    })
  });

  //Change AEX Option
  $('#aex_destination').on('change', function(e) {
    $('#preloader_checkout').show();
    $('.js-city').trigger('change');
  });
</script>

{{-- If user is authenticated, bypass zipcode checking and just trigger the selects --}}
@if (Auth::check())
<script>
    var user_zipdata = {
        city: '{{ Auth::user()->city ?? "" }}',
        city_id: {{ Auth::user()->city_id ?? 0 }},
        country_id: {{ Auth::user()->country_id ?? 0 }},
        state_id: {{ Auth::user()->state_id ?? 0 }},
        state_name: '{{ Auth::user()->state ?? "" }}',
        uf: '{{ Auth::user()->state->initial ?? "" }}',
        zipcode: '{{ Auth::user()->zip ?? "" }}'
      };
      $('#billCountry').trigger('change', user_zipdata);
</script>
@endif

{{-- If session is available, bypass zipcode checking and just trigger the selects --}}
@if (Session::has('session_order'))
<script>
    $('#has_temporder').val('true');
      var session_zipdata = {
        city: '{{ session()->get("session_order")["customer_city"] ?? "" }}',
        city_id: {{ session()->get("session_order")["customer_city_id"] ?? 0 }},
        country_id: {{ session()->get("session_order")["customer_country_id"] ?? 0 }},
        state_id: {{ session()->get("session_order")["customer_state_id"] ?? 0 }},
        state_name: '{{ session()->get("session_order")["customer_state"] ?? "" }}',
        uf: '{{ session()->get("session_order")["customer_state_initials"] ?? "" }}',
        zipcode: '{{ session()->get("session_order")["customer_zip"] ?? "" }}'
      };
      $('#billCountry').trigger('change', session_zipdata);
</script>
@endif

@include('includes.checkout-flow-scripts')

@endsection
