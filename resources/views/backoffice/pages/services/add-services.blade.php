@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Services</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add new service</h3>
    </div>
    <form id="form" enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\ServicesController@store') }}" >
        {{ csrf_field() }}  
        <div class="box-body">
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title" placeholder="Title" required>
            </div>
        </div>
  

        <div class="box-body">
            <div class="input-group width100">
                <textarea id="elm1" name="description" id="description" class="form-control" ></textarea>
            </div>
        </div>

        <div class="box-body">
            <div id="main-image">Main Image</div>
        </div>


        <div class="box-footer">
            <button type="submit"  class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>


jQuery( document ).ready(function() {
    function fileUploader(name,folder,maxFiles,acceptedTypes){
        jQuery("#"+name).uploadFile({
        url:'{{ action("backoffice\ServicesController@imageUpload") }}',
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
            jQuery.post("{{ action('backoffice\ServicesController@imageDelete') }}", {
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