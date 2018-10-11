@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Portfolio</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add new project</h3>
    </div>
    <form enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\PortfolioController@store') }}">
        {{ csrf_field() }}  
        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title" placeholder="Title" required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Title is required">
            </div>
            <div id="errorTitle" name="errordiv1" class="error-span"></div>
        </div>
        <div class="box-body">
            <div class="input-group width100">
                <textarea id="elm1" name="description" id="description" class="form-control"  required="" data-parsley-errors-container="#errorDescription" data-parsley-error-message="Description is required"  aria-hidden="true" data-parsley-id="5609"></textarea>
            </div>
            <div id="errorDescription" name="errordiv1" class="error-span"></div>
        </div>

        <div class="box-body">
            <div class="input-group width100">
                <select class="form-control select2" id="servicesId" name="servicesId" style="width: 100%;" required="" data-parsley-errors-container="#errorService" data-parsley-error-message="Please choose a service">
                    <option selected="selected" disabled>Choose one option</option>
                    @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
            <div id="errorService" name="errordiv1" class="error-span"></div>
        </div>
        
        <div class="box-body">
            <div id="main-image">Main</div>
        </div>

        <div class="box-body">
            <div id="slider">Main</div>
        </div>


        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>



<style>

</style>


<script>
jQuery( document ).ready(function() {
    jQuery("form").parsley();

    function fileUploader(name,folder,maxFiles,acceptedTypes){
        jQuery("#"+name).uploadFile({
        url:'{{ action("backoffice\PortfolioController@imageUpload") }}',
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
            jQuery.post("{{ action('backoffice\PortfolioController@imageDelete') }}", {
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
    jQuery("#slider").onload = fileUploader('slider','tmp',20,'image/*');
});
</script>
@stop