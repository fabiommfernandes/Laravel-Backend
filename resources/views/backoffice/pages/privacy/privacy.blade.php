@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Privacy Policies</h1>
    
@stop

@section('content')
<div class="box-header">
    <a href="{{ route('admin.contacts.edit')}}"> 
        <i class="fa fa-edit blue-square"></i> 
    </a>
</div>

<div class="box scroll">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="input-group">
            {!! $privacy->description !!}
        </div>
    </div>


    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</div>


<style>

.scroll{
  overflow-y: scroll;
  height: 500px;
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