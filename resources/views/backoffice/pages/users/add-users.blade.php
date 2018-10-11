@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>User</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add new user</h3>
    </div>
    <form enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\UsersController@store') }}">
        {{ csrf_field() }}  
        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="name" placeholder="First name" required>
            </div>
        </div>

        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="lastname" placeholder="Last name" required>
            </div>
        </div>

        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
        </div>

        <div class="box-body">
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

        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <select class="form-control select2" name="type" id="type" style="width: 100%;">
                    <option selected="selected" disabled>Choose one option</option>
                    <option value="2">Administrator</option>
                    <option value="3">Publisher</option>
                    <option value="4">User</option>
                </select>
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

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
</script>

@stop