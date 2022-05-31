@extends('layouts.admin')

@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Pages') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-page-index') }}">{{ __('Pages') }}</a>
                    </li>
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
                                    <th width="50%">{{ __('Page Title') }}</th>
                                    <th>{{ __('Header') }}</th>
                                    <th>{{ __('Footer') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ADD / EDIT MODAL --}}

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="submit-loader">
                <img src="{{asset('assets/images/'.$admstore->admin_loader)}}" alt="">
            </div>
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}

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
                <p class="text-center">{{ __('You are about to delete this Page.') }}</p>
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
        ajax: '{{ route("admin-page-datatables") }}',
        columns: [
            {
                data: 'action',
                searchable: false,
                orderable: false
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'header',
                searchable: false,
                orderable: false
            },
            {
                data: 'footer',
                searchable: false,
                orderable: false
            }
        ],
        language: {
            url: '{{$datatable_translation}}',
            processing: '<img src="{{asset("assets/images/".$admstore->admin_loader)}}">'
        },
        drawCallback: function(settings) {
            $(this).find('.select').niceSelect();
            $(".checkboxHeader").on('click', function(){
                var id = $(this).attr("id").replace("checkbox-header-", "");
                var name = $(this).attr('name');
                var header = name.slice(-1);
                var headerNovo = (header == "0") ? "1" : "0";
                var nameNew = $(this).attr("name", name.slice(0, -1)+headerNovo);
                $.ajax({
                    type: 'GET',
                    url: '{{ url("admin/page/header") }}' + '/' + id + '/' + headerNovo
                });
            });
            $(".checkboxFooter").on('click', function(){
                var id = $(this).attr("id").replace("checkbox-footer-", "");
                var name = $(this).attr('name');
                var footer = name.slice(-1);
                var footerNovo = (footer == "0") ? "1" : "0";
                var nameNew = $(this).attr("name", name.slice(0, -1)+footerNovo);
                $.ajax({
                    type: 'GET',
                    url: '{{ url("admin/page/footer") }}' + '/' + id + '/' + footerNovo
                });
            });
        },
        initComplete: function(settings, json) {
            $(".btn-area").append('<div class="col-sm-4 text-right">' +
                '<a class="add-btn" data-href="{{route("admin-page-create")}}" data-header="{{ __("Add New Page") }}" id="add-data" data-toggle="modal" data-target="#modal1">' +
                '<i class="fas fa-plus"></i> {{ __("Add New Page") }}' +
                '</a>' +
                '</div>');
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
$(document).ready(function(){
    // First access - CurrentPage
    if(sessionStorage.getItem("CurrentPage") == undefined){
        sessionStorage.setItem("CurrentPage", 0);
    }
    $(document).on('click', 'a', function(e){ 
        var link = jQuery(this); 
        var x = '{{ Request::route()->getPrefix() }}';
        y = x.split("/");
        if(!(link.attr("data-href") || link.attr("href").indexOf("#") > -1 || link.attr("href").indexOf("javascript") > -1 || !(link.attr("href").indexOf("page")))){
            sessionStorage.setItem("CurrentPage", 0);
            table.state.clear();
        }
    });
});

</script>
@endsection