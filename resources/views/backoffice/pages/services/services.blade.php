@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Services</h1>
@stop

@section('content')

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Services</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
              <tr data-toggle="collapse" data-target="#{{ $service->id }}" role="button">
                  <td>
                      {{ $service->title }}
                      <div class="collapse expand" id="{{ $service->id }}">
                          <div class="card card-body">
                              <a href="{{ route('admin.services.edit', ['id' => $service->id ])}}"> 
                                <i class="fa fa-edit blue-square"></i> 
                              </a> 
                              
                              <a href="{{ route('admin.services.delete', ['id' => $service->id ])}}" onclick="return confirm('When delting this u')"> 
                                <i class="fa fa-close red-square"></i> 
                              </a> 
                          </div>
                      </div>
                  </td>
                  
                  <td class="text-center">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                          Preview description
                      </button>

                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">{{ $service->title }}</h4>
                            </div>
                            <div class="modal-body">
                            {!! $service->description !!}
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                      <i class="fa fa-level-down right0" ></i>

                  </td>
              </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Description</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</div>

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
</style>

<script>
  jQuery(function () {
    jQuery('#example1').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true
    })

  })
</script>

@stop