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


<style>

    
.padding0{
    padding: 0;
}
.fa-eye,.fa-eye-slash{
    position: absolute;
    right: 10px;
    z-index: 10;
    top: 10px;
    font-size: 15px;
}

.feedback {
	color: rgba(0,0,0,0.4);
	font-size: 0.8em;
	padding: 0 .25em;
	margin-top: 1em;
}

#password-strength-text {
  margin-top: -5px;
  margin-bottom: 1em;
}
#feedback-bubble {
  margin-top: 20px;
  position: relative;
  width: 100%;
  padding: 0em;
  background: #fff;
  padding: .5em .7em;
  border-bottom: #0096fa solid .2em;
  font-size: 1em;
}

#feedback-bubble:after {
  content: '';
  position: absolute;
  border-style: solid;
  border-width: 0 15px 15px;
  border-color: #fff transparent;
  display: block;
  width: 0;
  z-index: 1;
  margin-left: -15px;
  top: -15px;
  left: 15%;
}

.passtrengthMeter .showPassword {
    top: 7px !important;
    z-index: 10;
}

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