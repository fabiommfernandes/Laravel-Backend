@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Privacy Policies</h1>
    
@stop

@section('content')
<div class="box-header">
    <a onclick="enableInputs()"> 
        <i class="fa fa-edit blue-square"></i> 
    </a>
</div>


<form id="form" enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\PrivacyController@update') }}">
  {{ csrf_field() }}  
  <div class="box scroll">
    <!-- /.box-header -->
    <div class="box-body descriptionFirst">
        <div class="input-group">
            {!! $privacy->description !!}
        </div>
    </div>

    <div class="input-group width100 descriptionShow" style="display: none;">
        <textarea id="elm1" name="description" id="description" class="form-control">{!! $privacy->description !!}</textarea>
    </div>

    <input type="hidden" name="id" value="{{ $privacy->id }}">

    <!-- /.box-body -->
  </div>
  <div class="box-footer submit" style="display: none;">
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  <!-- /.box -->
  </div>
  <!-- /.col -->
  </div>
</form>

{!! Toastr::message() !!}

<script>


function enableInputs(){
    if(jQuery('.submit').is(':visible')){

        jQuery('.descriptionFirst').css('display','block');
        jQuery('.scroll').css('overflow', 'scroll');
        jQuery('.scroll').css('height', '500px');
        jQuery('.descriptionShow').css('display','none');
        jQuery('.submit').css('display','none');



    }else{
        jQuery('.descriptionFirst').css('display','none');
        jQuery('.scroll').css('overflow', 'hidden');
        jQuery('.scroll').css('height', 'auto');
        jQuery('.descriptionShow').css('display','block');
        jQuery('.submit').css('display','block');
    }

}

</script>

@stop