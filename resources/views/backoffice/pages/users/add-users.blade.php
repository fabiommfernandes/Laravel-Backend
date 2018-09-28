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
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
        </div>

        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                </select>
            </div>
        </div>
            
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@stop