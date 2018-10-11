@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>My Profile</h1>
@stop

@section('content')

<div class="box-header">
    <a onclick="enableInputs()"> 
        <i class="fa fa-edit blue-square"></i> 
    </a>
</div>

<form enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\UsersController@storeMyProfile', ['id' => $current['id'] ]) }}">
    {{ csrf_field() }}  
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="name" value="{{ $current['firstName'] }}" disabled required>
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="lastname" value="{{ $current['lastName'] }}" disabled required>
                </div>
            </div>

            <input type="text" class="form-control" name="email" value="{{ $user->getAttributes()['email'] }}" style="display: none;">
            <input type="text" class="form-control" name="id" value="{{ $user->getAttributes()['id'] }}" style="display: none;">
            <input type="text" class="form-control" name="type" value="{{ $user->getAttributes()['type'] }}" style="display: none;">

            <div class="box-body passwordinput" style="display: none;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-repeat"></i></span>
                    <!---<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>-->
                    <div clas="row">
                        <div class="col-md-10 padding0">
                            <input type="password" class="form-control"  name="password" id="password" placeholder="Password" required>
                            <i class="fa fa-eye show-hide-password" id="show-hide-password"></i>
                        </div>
                        <div class="col-md-2">
                            <span class="btn btn-primary btn-flat" id="generate" onclick="randomString();" value="Generate password" >Generate password</span>  
                        </div>
                    </div>
                </div>  
            
            <div id="password-strength-text"></div>
    
            </div>

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

<script>

function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz@!#$%&/=?=/&%$#!|+*-/.-,;_";
	var string_length = 25;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
    }
    
    jQuery('#password').val(randomstring);

    var event = new Event('input');
    var password = document.getElementById('password');
    password.dispatchEvent(event);


}


jQuery( document ).ready(function() {
    jQuery( "#show-hide-password" ).click(function() {
        if(jQuery('#password')[0].type == 'password'){
            jQuery('#password')[0].type = "text";
            jQuery('#show-hide-password').removeClass('fa-eye').addClass('fa-eye-slash');

        }else{
            jQuery('#password')[0].type = "password";
            jQuery('#show-hide-password').removeClass('fa-eye-slash').addClass('fa-eye');

        }
    });
});

var strength = {
		0: "Worst",
		1: "Bad",
		2: "Weak",
		3: "Good",
		4: "Strong"
}

var password = document.getElementById('password');
var text = document.getElementById('password-strength-text');

password.addEventListener('input', function()
{
    var val = password.value;
    var result = zxcvbn(val);
	
   
    // Update the text indicator
    if(val !== "") {
        text.innerHTML = "<div id='feedback-bubble'><strong>Password strength</strong>: " + strength[result.score] + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span></div>"; 
    }
    else {
        text.innerHTML = "";
    }
});

function enableInputs(){
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


    jQuery(function () {
        jQuery('#example1').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
        })

    })
</script>

@stop