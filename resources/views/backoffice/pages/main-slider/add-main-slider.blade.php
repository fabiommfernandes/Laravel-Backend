@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Main slider</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add new slide</h3>
    </div>
    <form id="form" data-toggle="validator" enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\MainSliderController@store') }}" >
        {{ csrf_field() }}  
        <div class="box-body">
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title" placeholder="Title" required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Title is required">
            </div>
            <div id="errorTitle" name="errordiv1" class="error-span"></div>
        </div>


        <div class="box-body">
            <div id="main-image">Image</div>
        </div>

        <div class="box-footer">
            <button type="submit"  class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>


jQuery( document ).ready(function() {

    jQuery("form").parsley();

    function fileUploader(name,folder,maxFiles,acceptedTypes){
        jQuery("#"+name).uploadFile({
        url:'{{ action("backoffice\MainSliderController@imageUpload") }}',
        fileName: name,
        acceptFiles: acceptedTypes,
        showPreview: true,
        maxFileCount: maxFiles,
        maxFileSize: '30000000',
        formData: {
            "_token":"{{ csrf_token() }}", 
            "name": name,
            "folder": folder
        },
        previewHeight: "100px",
        previewWidth: "100px",
        showDelete: true,
        deleteCallback: function (imageName, action) {
            jQuery.post("{{ action('backoffice\MainSliderController@imageDelete') }}", {
                action: "delete",
                imageName: imageName,
                "folder": folder,
                "name": name,
                _token:"{{ csrf_token() }}"},
                function (resp,textStatus, jqXHR) {
            });
        },
    }); 
    }

    jQuery("#main-image").onload = fileUploader('main-image','tmp',1,'image/*');

});

</script>


@stop