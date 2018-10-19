@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Main slider</h1>
@stop

@section('content')

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Slider</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Name</th>            
            <th>Image</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
            <tr data-toggle="collapse" data-target="#{{ $slider->id }}" role="button">
                    <td>
                        {{ $slider->title }}
                        <div class="collapse expand" id="{{ $slider->id }}">
                            <div class="card card-body">
                                <a href="{{ route('admin.main-slider.edit', ['id' => $slider->id ])}}"> 
                                  <i class="fa fa-edit blue-square"></i> 
                                </a> 
                                
                                <a href="{{ route('admin.main-slider.delete', ['id' => $slider->id ])}}" onclick="return confirm('Are you sure you want to delete?')"> 
                                  <i class="fa fa-close red-square"></i> 
                                </a> 
                            </div>
                        </div>
                    </td>
                    <td>
                        @php
                            $files = File::allFiles(public_path().'/images/main-slider'.'/'.$slider->id.'/main-image');
                            $mainImage = $files[0]->getfilename();
                            $asset = asset('/images/main-slider/'.$slider->id.'/main-image'.'/'.$mainImage);
                            echo "<img style=\"height: 80px;\"=\"img-responsive\" src=". $asset .">";
                        @endphp
                        <i class="fa fa-level-down right0" ></i>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Name</th>
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