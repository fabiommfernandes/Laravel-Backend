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
    <form  enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\ServicesController@store') }}" >
        {{ csrf_field() }}  
        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="title" placeholder="Title"  data-parsley-required="true" data-parsley-errors-container="#title-error" required>
            </div>
            <span id="title-error"></span>

        </div>
  

        <div class="box-body">
            <div class="input-group width100">
                <textarea id="elm1" name="description" id="description" class="form-control" data-parsley-errors-container="#description-error" required></textarea>
            </div>
            <span id="description-error"></span>
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

.container {
  margin-top: 20px;
}

.panel-heading {
  font-size: larger;
}



/**
 * Error color for the validation plugin
 */

.parsley-errors-list {
  color: #e74c3c;
}
</style>


<script>
var $form = $("form"),
  $successMsg = $(".alert");
$form.parsley().on("form:submit", function(){
  $successMsg.show();
  return false; // avoid submitting
});

window.Parsley
  .addValidator('multipleOf', {
    requirementType: 'string',
    validateNumber: function(value, requirement) {
      return 0 === value % requirement;
    },
    messages: {
      en: 'This value should be a multiple of %s',
      fr: 'Cette valeur doit être un multiple de %s'
    }
  });
</script>
@stop