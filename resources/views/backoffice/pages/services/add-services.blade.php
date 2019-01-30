@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Servicos</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Adicionar novo serviço</h3>
    </div>
    <form id="form" class="tab-content" data-toggle="validator" enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\ServicesController@store') }}" >
        {{ csrf_field() }} 
        <!-- PT -->
        <h3> PT </h3>
        <div class="box-body">
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title-pt" placeholder="Title" required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Titlo é obrigatório">
            </div>
            <div id="errorTitle" name="errordiv1" class="error-span"></div>
        </div>

        <div class="box-body">
            <div class="input-group width100">
                <textarea id="elm1" data-type="textarea"  name="description-pt" required="" data-parsley-errors-container="#errorDescription" data-parsley-error-message="Descrição é obrigatória"  aria-hidden="true" data-parsley-id="5609" ></textarea>
            </div>
            <div id="errorDescription" name="errordiv1" class="error-span"></div>
        </div>

        <!-- EN -->
        <hr>
        <h3>EN</h3>
        <div class="box-body">
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title-en" placeholder="Title" required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Titlo é obrigatório">
            </div>
            <div id="errorTitle" name="errordiv1" class="error-span"></div>
        </div>

        <div class="box-body">
            <div class="input-group width100">
                <textarea id="elm2" data-type="textarea"  name="description-en" required="" data-parsley-errors-container="#errorDescription" data-parsley-error-message="Descrição é obrigatória"  aria-hidden="true" data-parsley-id="5609" ></textarea>
            </div>
            <div id="errorDescription" name="errordiv1" class="error-span"></div>
        </div>

        <!-- FR -->
        <hr>
        <h3>FR</h3>
        <div class="box-body">
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title-fr" placeholder="Title" required="" data-parsley-errors-container="#errorTitle" data-parsley-error-message="Titlo é obrigatório">
            </div>
            <div id="errorTitle" name="errordiv1" class="error-span"></div>
        </div>
    
        <div class="box-body">
            <div class="input-group width100">
                <textarea id="elm3" data-type="textarea"  name="description-fr" required="" data-parsley-errors-container="#errorDescription" data-parsley-error-message="Descrição é obrigatória"  aria-hidden="true" data-parsley-id="5609" ></textarea>
            </div>
            <div id="errorDescription" name="errordiv1" class="error-span"></div>
        </div>
    
        <!-- Imagem -->
        <hr>
        <h3>Imagem</h3>
        <div class="box-body">
                <div id="main-image">Imagem</div>
            </div>

        <!-- submit -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submeter</button>
        </div>
    </form>
</div>

<script>


jQuery( document ).ready(function() {

    jQuery("form").parsley();

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