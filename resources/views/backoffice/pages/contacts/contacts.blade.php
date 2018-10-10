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
.red-square{
    background-color: #dd4b39;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    color: white;
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: #d73925;
}
.red-square:hover{
  background: #d73925;
}

.blue-square{
    background-color: #337ab7;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    color: white;
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: #337ab7;
}
.blue-square:hover{
  background: #367fa9;
}

.expand{
  margin-top: 15px;
}
.fa-level-down{
  color: #337ab7;
}
.right0{
  position: absolute;
  right: 30px;
}

.text-center{
    font-size: 12px;
}
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