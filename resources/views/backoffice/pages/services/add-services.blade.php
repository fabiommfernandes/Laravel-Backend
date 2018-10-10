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



<style>
.width100{
    width: 100%;
}
.ajax-upload-dragdrop{
    border: 2px solid #d2d6de !important;
    width: 100% !important;
}

</style>


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

 //Rich text editor
   tinymce.init({
      selector: "#elm1",
      theme: "modern",
      plugins: [
           "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
           "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
           "save table contextmenu directionality emoticons template paste textcolor image code"
     ],
     toolbar: "insertfile undo redo | link image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
     style_formats: [
          {title: 'Bold text', inline: 'b'},
          {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
          {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
          {title: 'Example 1', inline: 'span', classes: 'example1'},
          {title: 'Example 2', inline: 'span', classes: 'example2'},
          {title: 'Table styles'},
          {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
      ],

      // enable title field in the Image dialog
    image_title: true, 
    // enable automatic uploads of images represented by blob or data URIs
    automatic_uploads: true,
    // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
    // images_upload_url: 'postAcceptor.php',
    // here we add custom filepicker only to Image dialog
    file_picker_types: 'image', 
    // and here's our custom image picker
    file_picker_callback: function(cb, value, meta) {
      var input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
      
      // Note: In modern browsers input[type="file"] is functional without 
      // even adding it to the DOM, but that might not be the case in some older
      // or quirky browsers like IE, so you might want to add it to the DOM
      // just in case, and visually hide it. And do not forget do remove it
      // once you do not need it anymore.
  
      input.onchange = function() {
        var file = this.files[0];
        
        var reader = new FileReader();
        reader.onload = function () {
          // Note: Now we need to register the blob in TinyMCEs image blob
          // registry. In the next release this part hopefully won't be
          // necessary, as we are looking to handle it internally.
          var id = 'blobid' + (new Date()).getTime();
          var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          var base64 = reader.result.split(',')[1];
          var blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);
  
          // call the callback and populate the Title field with the file name
          cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
      };
      
      input.click();
    }
  }); 
</script>
@stop