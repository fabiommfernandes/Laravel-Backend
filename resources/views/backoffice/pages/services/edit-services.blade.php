@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Serviços</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Editar serviço</h3>
    </div>
    <form id="form" class="tab-content" data-toggle="validator" enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\ServicesController@update') }}" >
        {{ csrf_field() }} 

        <div class="box-body">
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title-pt" value="{{ $servicePt->title }}" required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Titlo é obrigatório">
            </div>
            <div id="errorTitle" name="errordiv1" class="error-span"></div>
        </div>

        <div class="box-body">
            <div class="input-group width100">
                <textarea id="elm1" data-type="textarea"  name="description-pt" required="" data-parsley-errors-container="#errorDescription" data-parsley-error-message="Descrição é obrigatória"  aria-hidden="true" data-parsley-id="5609" > {{ $servicePt->description }}</textarea>
            </div>
            <div id="errorDescription" name="errordiv1" class="error-span"></div>
        </div>
    
        <div class="box-body">
                <div id="main-image">Imagem</div>
            </div>
        
        <input type="hidden" name="id" id="id" value="{{ $service->id }}">

        <!-- submit -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submeter</button>
        </div>
    </form>
</div>

    
<script>


jQuery( document ).ready(function() {
    


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