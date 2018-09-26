@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Services</h1>
@stop

@section('content')

<a class="btn btn-app"  href="{{ route('services.admin.create') }}"> 
    <i class="fa fa-plus"></i> Add Service
</a>

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
          </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr data-toggle="collapse" href="#{{ $service->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                <td>
                    {{ $service->title }}
                    <div class="collapse" id="{{ $service->id }}">
                        <div class="card card-body">
                            <a> 
                                <button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button>
                            </a>
                                <button type="button" class="btn btn-danger"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                </td>
                

            </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Name</th>
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

<script src="{{ asset('js/jquery/dist/jquery.min.js') }}"></script>

<script src="{{ asset('js/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


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