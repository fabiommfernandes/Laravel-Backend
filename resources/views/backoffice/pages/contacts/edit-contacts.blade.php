@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Contacts</h1>
@stop

@section('content')
<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Contacts</h3>
        </div>
        <form enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\ContactsController@update') }}">
            {{ csrf_field() }}  
            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="email" class="form-control" name="email" value="{{ $contact->email }}">
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}">
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="secondaryPhone" value="{{ $contact->secondaryPhone }}">
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="adress" value="{{ $contact->adress }}">
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="facebook" value="{{ $contact->facebook }}">
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="twitter" value="{{ $contact->twitter }}">
                </div>
            </div>

            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" name="linkedin" value="{{ $contact->linkedin }}">
                </div>
            </div>

            <input type="hidden" name="id" value="{{ $contact->id }}">

          
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    
    

<style>
  .width100{
    width: 100%;
  }
</style>

@stop