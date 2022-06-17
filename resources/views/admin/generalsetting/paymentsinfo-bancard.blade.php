@extends('layouts.admin')

@section('styles')

<style type="text/css">
    .img-upload #image-preview {
        background-size: unset !important;
    }

    .mr-breadcrumb .links .action-list li {
        display: block;
    }

    .mr-breadcrumb .links .action-list ul {
        overflow-y: auto;
        max-height: 240px;
    }

    .mr-breadcrumb .links .action-list .go-dropdown-toggle {
        padding-left: 20px;
        padding-right: 30px;
    }
</style>

@endsection

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Gateways') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-gs-payments-index') }}">{{__('Payment Methods')}}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin-gs-payments-gateway') }}">{{ __('Gateways') }}</a>
                    </li>
                    @if(config('features.multistore'))
                    <li>
                        <div class="action-list godropdown">
                            <select id="store_filter" class="process select go-dropdown-toggle">
                                @foreach ($stores as $store)
                                <option
                                    value="{{ route('admin-stores-isconfig',['id' => $store['id'], 'redirect' => true]) }}"
                                    {{$store['id']==$admstore->id ? 'selected' : ''}}>{{$store['domain']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @include('includes.admin.partials.gateway-tabs')
    <div class="add-product-content social-links-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area">
                        <div class="gocover" style="background: url({{asset('storage/images/'.$admstore->admin_loader)}})
                                no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                @include('includes.admin.partials.gateway-menu')
                            </div>
                            <div class="col-lg-9">
                                <form action="{{ route('admin-gs-update-payment') }}" id="geniusform" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    @include('includes.admin.form-both')

                                    <div class="row">

                                        <div class="col-xl-4">
                                            <div class="input-form input-form-center">
                                                <h4 class="heading">
                                                    {{ __('Bancard') }}
                                                </h4>
                                                <div class="action-list">
                                                    <select
                                                        class="process select droplinks {{ $admstore->is_bancard == 1 ? 'drop-success' : 'drop-danger' }}">
                                                        <option data-val="1" value="{{route('admin-gs-bancard',1)}}" {{
                                                            $admstore->is_bancard == 1 ? 'selected' : '' }}>
                                                            {{ __('Activated') }}
                                                        </option>
                                                        <option data-val="0" value="{{route('admin-gs-bancard',0)}}" {{
                                                            $admstore->is_bancard == 0 ? 'selected' : '' }}>
                                                            {{ __('Deactivated') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="input-form input-form-center">
                                                <h4 class="heading">{{ __('Bancard Sandbox Check') }} *
                                                    <span><i class="icofont-question-circle" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="{{__('Enable the sandbox mode to make payment tests only, it will not work for real purchases.')}}"></i>
                                                    </span>
                                                </h4>
                                                <label class="switch">
                                                    <input type="checkbox" name="bancard_mode" value="1" {{
                                                        $admstore->bancard_mode == 'sandbox' ? "checked":"" }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="input-form">
                                                <h4 class="heading">{{ __('Bancard Public Key') }} *
                                                    <span>
                                                        <i class="icofont-question-circle" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="{{__('Consult your public key with the payment method provider.')}}"></i>
                                                    </span>
                                                </h4>
                                                <textarea class="input-field" name="bancard_public_key"
                                                    placeholder="{{ __('Bancard Public Key') }}">{{ $admstore->bancard_public_key }}</textarea>

                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="input-form">
                                                <h4 class="heading">{{ __('Bancard Private Key') }} *
                                                    <span>
                                                        <i class="icofont-question-circle" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="{{__('Consult your private key with the payment method provider.')}}"></i>
                                                    </span>
                                                </h4>
                                                <textarea class="input-field" name="bancard_private_key"
                                                    placeholder="{{ __('Bancard Private Key') }}">{{ $admstore->bancard_private_key }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="input-form">
                                                @component('admin.components.input-localized',["from" => $admstore,
                                                "type" => "textarea"])
                                                @slot('name')
                                                bancard_text
                                                @endslot
                                                @slot('value')
                                                bancard_text
                                                @endslot
                                                {{ __('Bancard Text') }} * <span><i class="icofont-question-circle"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="{{__('Enter the message that will be displayed to the customer when using the payment method.')}}"
                                                        style="margin-top: -120px; margin-right:42px;"></i></span>
                                                @endcomponent

                                            </div>
                                        </div>



                                    </div>
                                    <!--FECHAMENTO TAG ROW-->

                                    <div class="row justify-content-center">

                                        <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('document').ready(function () {
      $("#store_filter").niceSelect('update');
  });

  $("#store_filter").on('change', function () {
    window.location.href = $(this).val();
  });
</script>
@endsection
