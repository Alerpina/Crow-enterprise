@extends('layouts.admin')

@section('styles')
<style>
    .presentation-pos {
        color: black;
        background-color: #e9e9ed;
        text-align: center;
        width: 30%;
        border: 1px dashed #b5b5b582;
        border-radius: 7px;
        margin-left: 30%;
        float: left;
    }
</style>
@endsection

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Main Categories') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li><a href="{{ route('admin-cat-index') }}">{{ __('Categories') }}</a></li>
                    <li>
                        <a href="{{ route('admin-cat-index') }}">{{ __('Main Categories') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('includes.admin.partials.category-tabs')
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table allproduct">

                    @include('includes.admin.form-success')

                    <div class="table-responsiv">
                        <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="20%"><i class="icofont-options icofont-lg" data-toggle="tooltip"
                                            title='{{ __("Options") }}'></i></th>
                                    <th>{{ __('Name') }}</th>
                                    <th><i class="icofont-basket icofont-lg" data-toggle="tooltip"
                                            title='{{ __("Products") }}'></i></th>
                                    <th>{{ __("Attribute Count") }}</th>
                                    <th><i class="icofont-eye icofont-lg" data-toggle="tooltip"
                                            title='{{ __("Status") }}'></i></th>
                                    <th>{{ __("Presentation Position") }}</th>
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
                <img src="{{asset('storage/images/'.$admstore->admin_loader)}}" alt="">
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

{{-- ATTRIBUTE MODAL --}}

<div class="modal fade" id="attribute" tabindex="-1" role="dialog" aria-labelledby="attribute" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="submit-loader">
                <img src="{{asset('storage/images/'.$admstore->admin_loader)}}" alt="">
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

{{-- ATTRIBUTE MODAL ENDS --}}

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
                <p class="text-center">
                    {{ __('You are about to delete this Category. Everything under this category will be deleted') }}.
                </p>
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

{{-- GALLERY MODAL --}}
@if(env("ENABLE_CUSTOM_PRODUCT"))
<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endif
{{-- GALLERY MODAL ENDS --}}

@endsection

@section('scripts')

{{-- DATA TABLE --}}

<script>
    var table = $('#geniustable').DataTable({
        stateSave: true,
        stateDuration: -1,
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin-cat-datatables") }}',
        columns: [
            {
                data: 'action',
                searchable: false,
                orderable: false
            },
            {
                data: 'name',
                render: function(data, type, row){
                    return row.name + '<br><small> slug: ' + row.slug + '</small>';
                },
            },
            {
                data: 'products',
                name: 'products',
                searchable: false,
                orderable: false
            },
            {
                data: 'attr_count',
                name: 'attr_count',
                searchable: false
            },
            {
                data: 'status',
                searchable: false,
                orderable: false
            },
            {
                data: 'presentation_position',
                name: 'presentation_position',
                searchable: false,
                orderable: false
            },
        ],
        language: {
            url: '{{$datatable_translation}}',
            processing: '<img src="{{asset("storage/images/".$admstore->admin_loader)}}">'
        },
        drawCallback: function(settings) {
            $(this).find('.select').niceSelect();
            $(".checkboxStatus").on('click', function(){
                var id = $(this).attr("id").replace("checkbox-status-", "");
                var name = $(this).attr('name');
                var status = name.slice(-1);
                var statusNovo = (status == "0") ? "1" : "0";
                var nameNew = $(this).attr("name", name.slice(0, -1)+statusNovo);
                $.ajax({
                    type: 'GET',
                    url: '{{ url("admin/category/status") }}' + '/' + id + '/' + statusNovo
                });
            });
            $('.presentation-pos').on('change', function() {
                $(this).val(Math.abs($(this).val()));
                var id = $(this).attr('data-cat');
                var pos = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{url("admin/category/changeCatPos") }}' + '/' + id + '/' +  pos
                });
                $.notify('{{__("New Category Position Added")}}', "success");
            });
        },
        initComplete: function(settings, json) {
            $(".btn-area").append('<div class="col-sm-4 table-contents">' +
                '<a class="add-btn" data-href="{{route("admin-cat-create")}}" data-header="{{__("Add New Category")}}" id="add-data" data-toggle="modal" data-target="#modal1">' +
                '<i class="fas fa-plus"></i> {{__("Add New Category")}}' +
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
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    function deleteImage(id, target, targetBtn) {
        $.ajax({
            url: '{{route("admin-cat-delete-image")}}',
            type: 'POST',
            data: {'id': id, 'target': target},
            success: function(data) {
                if (data.status) {
                    $('#modal1 .alert-success').show();
                    $('#modal1 .alert-success p').html(data.message);
                    $("#modal1 .modal-body").scrollTop(0);
                    $("#modal1").scrollTop(0);
                    $(targetBtn).parent().parent().parent().find(".img-preview").css({"background": data.noimage})
                }
                if ((data.errors)) {
                    for (var error in data.errors) {
                        $.notify(data.errors[error], 'danger');
                    }
                }
            }
        });
    }
    function deleteBanner(id, target, targetBtn) {
        $.ajax({
            url: '{{route("admin-cat-delete-banner")}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {'id': id, 'target': target},
            success: function(data) {
                if (data.status) {
                    $('#modal1 .alert-success').show();
                    $('#modal1 .alert-success p').html(data.message);
                    $("#modal1 .modal-body").scrollTop(0);
                    $("#modal1").scrollTop(0);
                    $(targetBtn).parent().parent().find(".img-preview").css({"background": data.noimage})
                }
                if ((data.errors)) {
                    for (var error in data.errors) {
                        $.notify(data.errors[error], 'danger');
                    }
                }
            }
        });
    }
</script>

{{-- DATA TABLE ENDS--}}

{{-- GALLERY IMAGES STARTS --}}

<script>
    // Gallery Section Update
    $(document).on('click', '.set-gallery', function() {
        var cid = $(this).find('input[type=hidden]').val();
        $('#cid').val(cid);
        $('.selected-image .row').html('');
            $.ajax({
            type: 'GET',
            url: '{{ route("admin-categorygallery-show") }}',
            data: {
                id: cid
            },
            success: function(data) {
                if (data[0] == 0) {
	                    $('.selected-image .row').addClass('justify-content-center');
	      				$('.selected-image .row').html('<h3>{{ __("No Images Found.") }}</h3>');
                } else {
                    if (data[2]) {
                        $('.selected-image .row').removeClass('justify-content-center');
                        $('.selected-image .row h3').remove();
                        for (var k in data[2]) {
                            $('.selected-image .row').append('<div class="col-sm-4">' +
                                '<div class="img gallery-img">'+
                                '<span class="remove-img"><i class="fas fa-times"></i>' +
                                '<input type="hidden" value="' + data[2][k]['id'] + '">' +
                                '</span>' +
                                '<a href="' + data[2][k] + '" target="_blank">' +
                                '<img src="' + data[2][k] + '" alt="gallery image">' +
                                '<div>' + data[2][k]['id'] + '</div>' +
                                '</a>' +
                                '</div>' +
                                        '</div>');
                        }
                    } else {
                        $('.selected-image .row').removeClass('justify-content-center');
                        $('.selected-image .row h3').remove();
                        var arr = $.map(data[1], function(el) {
                            return el
                        });
                        for (var k in arr) {
                            $('.selected-image .row').append('<div class="col-sm-4">' +
                                '<div class="img gallery-img">'+
                                '<span class="remove-img"><i class="fas fa-times"></i>' +
                                '<input type="hidden" value="' + arr[k]['id'] + '">' +
                                '</span>' +
                                '<div class="gallery-img-id"><span>' + arr[k]['id'] + '</span></div>' +
                                '<a href="' + '{{asset("storage/images/galleries")."/"}}' + arr[k][
                                    'customizable_gallery'
                                ] + '" target="_blank">' +
                                '<img src="' + '{{asset("storage/images/galleries")."/"}}' + arr[k][
                                    'customizable_gallery'
                                ] + '" alt="gallery image">' +
                                '</a>' +
                                '</div>' +
                                        '</div>');
                        }
                    }
                }
            }
            });
      });
    $(document).on('click', '.remove-img', function() {
    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
	    $.ajax({
            type: 'GET',
            url: '{{ route("admin-categorygallery-delete") }}',
            data: {
                id: id
            }
	    });
  });
    $(document).on('click', '#cat_gallery', function() {
    $('#uploadgallery').click();
  });
    $('#uploadgallery').change(function() {
        $('#form-gallery').submit();
  });
    $(document).on('submit', '#form-gallery', function() {
		  $.ajax({
            url: '{{ route("admin-categorygallery-store") }}',
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
            success: function(data) {
                if (data != 0) {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();
		        var arr = $.map(data, function(el) {
                        return el
                    });
                    for (var k in arr) {
                        $('.selected-image .row').append('<div class="col-sm-4">' +
                            '<div class="img gallery-img">' +
                            '<span class="remove-img"><i class="fas fa-times"></i>' +
                            '<input type="hidden" value="' + arr[k]['id'] + '">' +
                            '</span>' +
                            '<a href="' + '{{asset("storage/images/galleries")."/"}}' + arr[k][
                                'customizable_gallery'
                            ] + '" target="_blank">' +
                            '<img src="' + '{{asset("storage/images/galleries")."/"}}' + arr[k][
                                'customizable_gallery'
                            ] + '" alt="gallery image">' +
                            '</a>' +
                            '</div>' +
                                  	'</div>');
		            }
		    }
		                       }
		  });
		  return false;
 });
    // Gallery Section Update Ends

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
            if(!(link.attr("data-href") || link.attr("href").indexOf("#") > -1 || link.attr("href").indexOf("javascript") > -1 || !(link.attr("href").indexOf("category")))){
                sessionStorage.setItem("CurrentPage", 0);
                table.state.clear();
            }
        });
    });
</script>
{{-- GALLERY IMAGES ENDS --}}
{{-- CHANGE CATEGORY PRESENTATION POSITION --}}
<script>
    function changePos(id, val) {
        var id = id;
        var pos = val;
        $.ajax({
            type: 'GET',
            url: '{{url("admin/slider/changeCatPos") }}' + '/' + id + '/' +  pos

        });
    }
</script>
@endsection
