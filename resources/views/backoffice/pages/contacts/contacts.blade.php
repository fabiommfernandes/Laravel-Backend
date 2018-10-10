@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Contacts</h1>
@stop

@section('content')

<div class="box-header">
    <a onclick="enableInputs()"> 
        <i class="fa fa-edit blue-square"></i> 
    </a>
</div>

<form enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\ContactsController@update') }}">
    {{ csrf_field() }}  
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="email" class="form-control" name="email" value="{{ $contact->email }}" disabled>
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}" disabled>
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="secondaryPhone" value="{{ $contact->secondaryPhone }}" disabled>
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="adress" value="{{ $contact->adress }}" disabled>
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="facebook" value="{{ $contact->facebook }}" disabled>
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="twitter" value="{{ $contact->twitter }}" disabled>
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="linkedin" value="{{ $contact->linkedin }}" disabled>
                </div>
            </div>

            <input type="hidden" name="id" value="{{ $contact->id }}">

            <div class="box-footer submit" style="display: none;">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
</form>

{!! Toastr::message() !!}
<style>

</style>

<script>
function  enableInputs(){
    if(jQuery('.submit').is(':visible')){
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
        }
        jQuery('.submit').css('display','none');
        jQuery('.passwordinput').css('display','none');

    }else{
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
        jQuery('.submit').css('display','block');
        jQuery('.passwordinput').css('display','block');
    }
}
</script>

@stop