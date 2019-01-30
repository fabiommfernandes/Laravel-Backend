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
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
              <tr data-toggle="collapse" data-target="#{{ $service->id }}" role="button">
                  <td>
                    @php 
                      if( $servicesTranslations->where('servicesId', $service->id)->where('languageId', '1')->first() ){
                        echo $servicesTranslations->where('servicesId', $service->id)->where('languageId', '1')->first()->title;
                      }else{
                        echo "N/A";
                      }
                    @endphp
                      <div class="collapse expand" id="{{ $service->id }}">
                          <div class="card card-body">
                              <a href="{{ route('admin.services.edit', ['id' => $service->id ])}}"> 
                                <i class="fa fa-edit blue-square"></i> 
                              </a> 
                              
                              <a href="{{ route('admin.services.delete', ['id' => $service->id ])}}" onclick="return confirm('Are you sure you want to delete this service?')"> 
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
                              <h4 class="modal-title">Description</h4>
                            </div>
                            <div class="modal-body">
                              @php 
                                if( $servicesTranslations->where('servicesId', $service->id)->where('languageId', '1')->first() ){
                                  echo $servicesTranslations->where('servicesId', $service->id)->where('languageId', '1')->first()->description;
                                }else{
                                  echo "N/A";
                                }
                              @endphp
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                      <i class="fa fa-level-down right0" ></i>

                  </td>

                  <td>
                    @php
                    if( $service->main_image ) {
                        echo '<img src="'. $service->main_image .'" height="100" width="100">';

                    }else{
                        echo '<img src="/images/news/no-image/icon.png" height="100" width="100">';
                    }
                    @endphp
                    <!-- show logo thumbnail -->
                </td>
              </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
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

@stop