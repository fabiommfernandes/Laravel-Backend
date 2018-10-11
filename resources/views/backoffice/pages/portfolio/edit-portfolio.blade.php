@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Portofolio</h1>
@stop

@section('content')
<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add new project</h3>
        </div>
        <form enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\PortfolioController@update') }}">
            {{ csrf_field() }}  
            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="title" value="{{ $portfolio->title }}" required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Title is required">
                </div>
                <div id="errorTitle" name="errordiv1" class="error-span"></div>
            </div>
            <div class="box-body">
                <div class="input-group width100">
                    <textarea id="elm1" name="description" id="description" class="form-control" required="" data-parsley-errors-container="#errorDescription" data-parsley-error-message="Description is required"  aria-hidden="true" data-parsley-id="5609">{{ $portfolio->description }}</textarea>
                </div>
                <div id="errorDescription" name="errordiv1" class="error-span"></div>
            </div>

            <div class="box-body">
                <div class="input-group width100">
                    <select class="form-control select2" id="servicesId" name="servicesId" style="width: 100%;" required="" data-parsley-errors-container="#errorService" data-parsley-error-message="Please choose a service">
                        @foreach($services as $service)
                            @if($portfolio->servicesId == $service->id)
                                <option selected value="{{ $service->id }}"> {{ $service->title }} </option>
                            @else
                                <option value="{{ $service->id }}"> {{ $service->title }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div id="errorService" name="errordiv1" class="error-span"></div>
            </div>

            <input type="hidden" name="id" id="id" value="{{ $portfolio->id }}">

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
    

<script>
jQuery( document ).ready(function() {
    jQuery("form").parsley();

    function fileUploader(name,folder,maxFiles,acceptedTypes,folderName){

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
            "folder": "tmp"
        },
        previewHeight: "100px",
        previewWidth: "100px",
        showDelete: true,
        deleteCallback: function (imageName, action) {
            jQuery.post("{{ action('backoffice\PortfolioController@imageDelete') }}", {
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
                    url:'{{ action("backoffice\PortfolioController@imageLoad") }}',
                    dataType: "json",
                    data: {
                        "id": jQuery('#id').val(), 
                        "name": name
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

    jQuery("#main-image").onload = fileUploader('main-image',1,'image/*','main-image');
    jQuery("#slider").onload = fileUploader('slider',20,'image/*','slider');


}); 
</script>
    @stop