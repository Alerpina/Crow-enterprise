@extends('layouts.admin')

@section('styles')
<style>
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
                <h4 class="heading">{{ __('Languages') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-lang-index') }}">{{ __('Languages') }} </a>
                    </li>
                    @if(config('features.multistore'))
                    <li>
                        <div class="action-list godropdown">
                            <select id="store_filter" class="process select go-dropdown-toggle">
                                @foreach ($stores as $store)
                                <option
                                    value="{{ route('admin-stores-isconfig',['id' => $store['id'], 'redirect' => true]) }}"
                                    {{$store['id'] == $admstore->id ? 'selected' : ''}}>{{$store['domain']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table allproduct">

                    @include('includes.admin.form-success')

                    <div class="table-responsiv">
                        <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><i class="icofont-options icofont-lg" data-toggle="tooltip" title='{{ __("Options") }}'></i></th>
                                    <th><i class="icofont-globe icofont-lg" data-toggle="tooltip" title='{{ __("Language") }}'></i></th>
                                    <th><i class="icofont-ui-text-loading icofont-lg" data-toggle="tooltip" title='{{ __("Locale") }}'></i></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __('You are about to delete this Language.') }}</p>
                <p class="text-center">{{ __('Do you want to proceed?') }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
            </div>

        </div>
    </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection

@section('scripts')

<script type="text/javascript">
    var table = $('#geniustable').DataTable({
        stateSave: true,
        stateDuration: -1,
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin-lang-datatables") }}',
        columns: [
        {
            data: 'action',
            searchable: false,
            orderable: false
        },
        {
            data: 'language',
            name: 'language'
        }, 
        {
            data: 'locale',
            name: 'locale'
        }
        ],
        language: {
            url: '{{$datatable_translation}}',
            processing: '<img src="{{asset("assets/images/".$admstore->admin_loader)}}">'
        },
        drawCallback: function(settings) {
            $(this).find('.select').niceSelect();
        },
        initComplete: function(settings, json) {
            $(".btn-area").append('<div class="col-sm-4 text-right">' +
                '<a class="add-btn" href="{{route("admin-lang-create")}}">' +
                '<i class="fas fa-plus"></i> {{ __("Add New Language") }}' +
                '</a>' +
                '</div>'
            );
            /* 
            * Setando no Cookie a página atual
            */
            $("#geniustable").on('page.dt', function(){
                sessionStorage.setItem("CurrentPage", table.page());
            });
        }
    });
</script>

<script>
    $('document').ready(function() {
        $("#store_filter").niceSelect('update');
    });
    $("#store_filter").on('change', function() {
        window.location.href = $(this).val();
    });
    $(document).ready(function(){
        // First access - CurrentPage
        if(sessionStorage.getItem("CurrentPage") == undefined){
            sessionStorage.setItem("CurrentPage", 0);
        }
        $(document).on('click', 'a', function(e){ 
            var link = jQuery(this); 
            var x = '{{ Request::route()->getPrefix() }}';
            y = x.split("/");
            if(!(link.attr("data-href") || link.attr("href").indexOf("#") > -1 || link.attr("href").indexOf("javascript") > -1 || link.attr("href").indexOf(y[1]) > -1)){
                sessionStorage.setItem("CurrentPage", 0);
                table.state.clear();
            }
        });
    });
</script>
@endsection