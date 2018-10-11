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
        <form id="form" enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\ServicesController@update') }}">
            {{ csrf_field() }}  
            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="title" value="{{ $service->title }}"  required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Title is required">
                </div>
                <div id="errorTitle" name="errordiv1" class="error-span"></div>
            </div>
            <div class="box-body">
                <div class="input-group width100">
                    <textarea id="elm1" name="description" id="description" class="form-control" required="" data-parsley-errors-container="#errorDescription" data-parsley-error-message="Description is required"  aria-hidden="true" data-parsley-id="5609">{{ $service->description }}</textarea>
                </div>
                <div id="errorDescription" name="errordiv1" class="error-span"></div>
            </div>

            <div class="box-body">
                <div class="input-group width100">
                    <div id="main-image">Main Image</div>
                </div>
            </div>

            <input type="hidden" name="id" id="id" value="{{ $service->id }}">

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    
    <script>




jQuery( document ).ready(function() {
        
    jQuery("#form").parsley();

    function fileUploader(name,folder,maxFiles,acceptedTypes,folderName){
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
            "folder": "tmp"
        },
        previewHeight: "100px",
        previewWidth: "100px",
        showDelete: true,
        deleteCallback: function (imageName, action) {
            jQuery.post("{{ action('backoffice\ServicesController@imageDelete') }}", {
                action: "delete",
                imageName: imageName,
                "folder": "tmp",
                "name": name,
                _token:"{{ csrf_token() }}"},
                function (resp,textStatus, jqXHR) {
            });
        },
        onLoad:function(obj)
            {
                jQuery.ajax({
                    cache: false,
                    url:'{{ action("backoffice\ServicesController@imageLoad") }}',
                    dataType: "json",
                    data: {
                        "id": jQuery('#id').val(), 
                        "name": folderName
                    },
                    success: function(data) 
                    {
                        for(var i=0;i<data.length;i++)
                        { 
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"]);
                        }
                    }
                });
            }, 
    }); 
    }

    jQuery("#main-image").onload = fileUploader('main-image','main-image',1,'image/*','main-image');

});
    </script>
    @stop